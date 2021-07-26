import mysql.connector
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="be_project"
)
print(mydb)
mycursor = mydb.cursor()

sql = "SELECT * from predictions"
mycursor.execute(sql)
ALL = mycursor.fetchall()

Ticker_list=["INFY", "ACC", "ITC"]#, "ACN", "TCS", "ITC"

def sell_stock(price, company, buy_status, sell_status):
    if buy_status==sell_status=="yes":
        Ticker_list.remove(company)
        print(company+" done")

    elif sell_status!="yes":
        #sell code with zerodha api is remaining
        sql = "UPDATE predictions SET Sell = 'yes' WHERE company_name =" +"'"+company+"'"
        
        mycursor.execute(sql)
        mydb.commit()
        print(company+" sold at "+ price)

    elif sell_status=="yes":
        print("Already Sold shares of "+company)


def buy_stock(price, company, buy_status, sell_status):
    if buy_status==sell_status=="yes":
        Ticker_list.remove(company)
        print(company+" done")

    elif buy_status!="yes":
        #sell code with zerodha api is remaining
        sql = "UPDATE predictions SET Buy = 'yes' WHERE company_name =" +"'"+company+"'"
        
        mycursor.execute(sql)
        mydb.commit()
        print(company+" bought at "+ price)

    elif sell_status=="yes":
        print("Already Bought shares of "+company)

    

def buy_sell(price, company):
    print(company)
    sql = "SELECT * FROM predictions WHERE company_name = "+"'"+company+"'"
    
    mycursor.execute(sql)
    myresult = mycursor.fetchall()
    print(myresult)
    print(float(myresult[0][2]))
    if str(myresult[0][2])==price:
        sell_stock(price, company, str(myresult[0][4]), str(myresult[0][5]))
        
    elif str(myresult[0][3])==price:
        buy_stock(price, company, str(myresult[0][4]), str(myresult[0][5]))
        
    else:
        print("not equal")
         



import requests
from bs4 import BeautifulSoup

#, "ACN", "TCS", "ITC"

while(True):

    for ticker in Ticker_list:
    # print(ticker)

        stock_url  = 'https://www.nseindia.com/live_market/dynaContent/live_watch/get_quote/GetQuote.jsp?symbol='+str(ticker)
        # print(stock_url)
        headers = {'user-agent':'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36'}
        response = requests.get(stock_url, headers=headers)
        # response

        soup = BeautifulSoup(response.text, 'html.parser')

        data_array = soup.find(id='responseDiv').getText().strip().split(":")
        # type (data_array)

        for item in data_array:
            if 'lastPrice' in item:
                index = data_array.index(item)+1
                #print("Index -> "+ str(index))
                latestPrice=data_array[index].split('"')[1]
                print("Real Price: "+latestPrice)
                latestPrice=latestPrice.replace(',', '')
                buy_sell(latestPrice, ticker)
