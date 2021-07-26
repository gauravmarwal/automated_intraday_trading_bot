Ticker_list=["INFY", "ACC", "ITC", "ACN", "TCS"]#, "ACN", "TCS", "ITC"

import mysql.connector
import numpy as np

from stock_prediction import create_model, load_data
from parameters import *

from currency_converter import CurrencyConverter

c = CurrencyConverter()

def convert(amount): 
	''' converts USD to INR ''' 
	return round(c.convert(amount, 'USD', 'INR'), 2)

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="be_project"
)
print(mydb)
mycursor = mydb.cursor()

def predict(model, data):
    # retrieve the last sequence from data
    last_sequence = data["last_sequence"][-N_STEPS:]
    # expand dimension
    last_sequence = np.expand_dims(last_sequence, axis=0)
    # get the prediction (scaled from 0 to 1)
    prediction = model.predict(last_sequence)
    # get the price (by inverting the scaling)
    if SCALE:
        predicted_price = data["column_scaler"]["adjclose"].inverse_transform(prediction)[0][0]
        predicted_high = data["column_scaler"]["high"].inverse_transform(prediction)[0][0]
        predicted_low = data["column_scaler"]["low"].inverse_transform(prediction)[0][0]
        final_prediction = [predicted_price, predicted_high, predicted_low]

    else:
        predicted_price, predicted_high, predicted_low = prediction[0][0]
    return final_prediction

def updating_preds_table(tick, pred_list):
    mycursor.execute("SELECT company_name FROM predictions")

    Company_list = mycursor.fetchall()
    # for i in Company_list:
    print(Company_list)
        
    if tick in str(Company_list):
        print("('"+tick+"',)")
        sql = "UPDATE predictions SET predicted_price = %s, predicted_high = %s, predicted_low = %s WHERE company_name = %s"
        val = (str(convert(pred_list[0])), str(convert(pred_list[1])), str(convert(pred_list[2])), tick)

        mycursor.execute(sql, val)

        mydb.commit()

        print(mycursor.rowcount, "record(s) affected")
    
    else:
        print("('"+tick+"',)")
        
        sql = "INSERT INTO predictions VALUES (%s, %s, %s, %s, '', '')"
        val = (tick, str(convert(pred_list[0])), str(convert(pred_list[1])), str(convert(pred_list[2])))
        mycursor.execute(sql, val)

        mydb.commit()

        print(mycursor.rowcount, "record inserted.")


for tick in Ticker_list:
    print("for ", tick)
    model_name_1 = f"{date_now}_{tick}-{shuffle_str}-{scale_str}-{split_by_date_str}-\
{LOSS}-{OPTIMIZER}-{CELL.__name__}-seq-{N_STEPS}-step-{LOOKUP_STEP}-layers-{N_LAYERS}-units-{UNITS}"
    
    if BIDIRECTIONAL:
        model_name_1 += "-b"
    # load the data
    data = load_data(tick, N_STEPS, scale=SCALE, split_by_date=SPLIT_BY_DATE, 
                    shuffle=SHUFFLE, lookup_step=LOOKUP_STEP, test_size=TEST_SIZE, 
                    feature_columns=FEATURE_COLUMNS)

    # construct the model
    model = create_model(N_STEPS, len(FEATURE_COLUMNS), loss=LOSS, units=UNITS, cell=CELL, n_layers=N_LAYERS,
                        dropout=DROPOUT, optimizer=OPTIMIZER, bidirectional=True)

    # load optimal model weights from results folder
    model_path = os.path.join("results", model_name_1) + ".h5"
    model.load_weights(model_path)

    future_price_array = predict(model, data)
    future_price = convert(future_price_array[0])#adjclose
    future_high = convert(future_price_array[1])#high
    future_high_in_dollars = future_price_array[0]
    future_low = convert(future_price_array[2])#low
    print(f"Future price of {tick} after {LOOKUP_STEP} days is {future_price:.2f}")
    print(f"Future high of {tick} after {LOOKUP_STEP} days is {future_high:.2f}")
    print(f"Future high of {tick} in dollars, after {LOOKUP_STEP} days is {future_high_in_dollars:.2f}")
    print(f"Future low of {tick} after {LOOKUP_STEP} days is {future_low:.2f}")
    updating_preds_table(tick, future_price_array)


