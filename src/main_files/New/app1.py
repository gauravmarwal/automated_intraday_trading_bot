from flask import Flask, render_template, request
from flask_mysqldb import MySQL
import requests
app1 = Flask(__name__)


app1.config['MYSQL_HOST'] = 'localhost'
app1.config['MYSQL_USER'] = 'root'
app1.config['MYSQL_PASSWORD'] = ''
app1.config['MYSQL_DB'] = 'be_project'

mysql = MySQL(app1)


@app1.route('/', methods=['GET', 'POST'])
def index():
    company="INFY"
    if request.method == "POST" or "GET":
        mycursor = mysql.connection.cursor()
        mydb=mysql.connection
        insert_query="INSERT into logs values %s"
        var=company+" done"
        mycursor.execute("INSERT into logs values (%s)", (var,))
        mydb.commit()
        print("done")
        return 'success'
                mycursor.execute("INSERT into (logs) logs values (%s)", (var,))

if __name__ == '__main__':
    app1.run(debug=True)