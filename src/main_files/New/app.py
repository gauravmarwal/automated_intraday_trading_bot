from flask import Flask, render_template, request
from flask_mysqldb import MySQL
import requests
app = Flask(__name__)


app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'be_project'

mysql = MySQL(app)
global flag

def start():
    if request.method == "POST" or "GET":
        mycursor = mysql.connection.cursor()
        mydb=mysql.connection        
        sql = "SELECT * from predictions"
        mycursor.execute(sql)
        ALL = mycursor.fetchall()

        Ticker_list=["INFY", "ACC", "ITC", "ACN", "TCS"]#, "ACN", "TCS", "ITC"

        def sell_stock(price, company, buy_status, sell_status):
            if buy_status==sell_status=="yes":
                Ticker_list.remove(company)
                # insert_query="INSERT into logs values %s"
                var=company+" done"
                mycursor.execute("INSERT into logs (logs) values (%s)", (var,))
                mydb.commit()
                print(company+" done")

            elif sell_status!="yes":
                #sell code with zerodha api is remaining
                sql = "UPDATE predictions SET Sell = 'yes' WHERE company_name =" +"'"+company+"'"
                
                mycursor.execute(sql)
                mydb.commit()
                # insert_query="INSERT into logs values %s"
                var=company+" sold at "+ str(price)
                mycursor.execute("INSERT into logs (logs) values (%s)", (var,))
                mydb.commit()
                print(company+" sold at "+ price)

            elif sell_status=="yes":
                # insert_query="INSERT into logs values %s"
                var="Already Sold shares of "+company
                mycursor.execute("INSERT into logs (logs) values (%s)", (var,))
                mydb.commit()
                print("Already Sold shares of "+company)


        def buy_stock(price, company, buy_status, sell_status):
            if buy_status==sell_status=="yes":
                Ticker_list.remove(company)
                # insert_query="INSERT into logs values %s"
                var=company+" done"
                mycursor.execute("INSERT into logs (logs) values (%s)", (var,))
                mydb.commit()
                print(company+" done")

            elif buy_status!="yes":
                #sell code with zerodha api is remaining
                sql = "UPDATE predictions SET Buy = 'yes' WHERE company_name =" +"'"+company+"'"
                
                mycursor.execute(sql)
                mydb.commit()
                # insert_query="INSERT into logs values %s"
                var=company+" bought at "+ str(price)
                mycursor.execute("INSERT into logs (logs) values (%s)", (var,))
                mydb.commit()
                print(company+" bought at "+ price)

            elif buy_status=="yes":
                # insert_query="INSERT into logs values %s"
                var="Already Bought shares of "+company
                mycursor.execute("INSERT into logs (logs) values (%s)", (var,))
                mydb.commit()
                print("Already Bought shares of "+company)

            

        def buy_sell(price, company):
            print(company)
            sql = "SELECT * FROM predictions WHERE company_name = "+"'"+company+"'"
            
            mycursor.execute(sql)
            myresult = mycursor.fetchall()
            # insert_query="INSERT into logs values %s"
            var="Predicted High is "+str(myresult[0][2])+" & Predicted Low is "+str(myresult[0][1])
            mycursor.execute("INSERT into logs (logs) values (%s)", (var,))
            mydb.commit()
            print(myresult)
            print(float(myresult[0][2]))
            if str(myresult[0][2])==price:
                sell_stock(price, company, str(myresult[0][4]), str(myresult[0][5]))
                
            elif str(myresult[0][3])==price:
                buy_stock(price, company, str(myresult[0][4]), str(myresult[0][5]))
                
            else:
                print("Real price not equal to predicted price.")
                # insert_query="INSERT into logs values %s"
                var="Real price not equal to predicted price."
                mycursor.execute("INSERT into logs (logs) values (%s)", (var,))
                mydb.commit()
                



        import requests
        from bs4 import BeautifulSoup

        #, "ACN", "TCS", "ITC"

        while(flag):

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
                        # insert_query="INSERT into logs values %s"
                        var=("............")
                        mycursor.execute("INSERT into logs (logs) values (%s)", (var,))
                        mydb.commit()
                        print(var)
                        var=ticker
                        mycursor.execute("INSERT into logs (logs) values (%s)", (var,))
                        mydb.commit()
                        # insert_query="INSERT into logs values %s"
                        var="Real Price of: "+ticker+" is "+latestPrice
                        mycursor.execute("INSERT into logs (logs) values (%s)", (var,))
                        mydb.commit()
                        print("Real Price: "+latestPrice)
                        latestPrice=latestPrice.replace(',', '')
                        buy_sell(latestPrice, ticker)
    return 'success'
def stop1():
    import time
    time.sleep(5)
    if request.method == "POST" or "GET":
        mycursor = mysql.connection.cursor()
        mydb=mysql.connection 
        mycursor.execute("TRUNCATE TABLE logs")
        mydb.commit()
        print("trading stopped")





@app.route('/', methods=['GET', 'POST'])
def index():
    return 'sorry'
@app.route('/start', methods=['GET', 'POST'])
def start1():
    global flag
    flag=1
    # return 'started'
    start()
    return 'done'
@app.route('/stop', methods=['GET', 'POST'])
def stop():
    global flag
    flag=0
    stop1()
    return 'success'
    # exit()


    



if __name__ == '__main__':
    app.run(debug=True)
