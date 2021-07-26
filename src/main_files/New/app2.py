from flask import Flask, render_template, request
from flask_mysqldb import MySQL
import requests
app2 = Flask(__name__)

app2.config['MYSQL_HOST'] = 'localhost'
app2.config['MYSQL_USER'] = 'root'
app2.config['MYSQL_PASSWORD'] = ''
app2.config['MYSQL_DB'] = 'be_project'

mysql = MySQL(app2)
# Import the libraries
import tweepy
from textblob import TextBlob
from wordcloud import WordCloud
import pandas as pd
import numpy as np
import re
import matplotlib.pyplot as plt
plt.style.use('fivethirtyeight')
# Twitter Api Credentials
consumerKey = "Fl5LwAM592FRL7lk1AmT3fqd1"
consumerSecret = "iPIJTczIwFJbM9IeMW7jK5g1rYa9t2VKUIPbsn5DnIbyh1NnmC"
accessToken = "3285192114-Hw28zlt2T4NYjJnQTNsL2oUukHuIRRPpe1UTanL"
accessTokenSecret = "fu2wbwLO55cg6ArQclI3asC6myBJw6QnDRYGt4TrgimO8"
    # Create the authentication object
authenticate = tweepy.OAuthHandler(consumerKey, consumerSecret) 
       
    # Set the access token and access token secret
authenticate.set_access_token(accessToken, accessTokenSecret) 
        
    # Creating the API object while passing in auth information
api = tweepy.API(authenticate, wait_on_rate_limit = True)

arr = ['Infosys','ACC','ITC','Accenture','TCS', 'Reliance']
main = [0,0,0,0,0,0]
def get_sentiment():
    if request.method == "POST" or "GET":
        mycursor = mysql.connection.cursor()
        mydb=mysql.connection
        def cleanTxt(text):
            text = re.sub('@[A-Za-z0–9]+', '', text) #Removing @mentions
            text = re.sub('#', '', text) # Removing '#' hash tag
            text = re.sub('RT[\s]+', '', text) # Removing RT
            text = re.sub('https?:\/\/\S+', '', text) # Removing hyperlink

            return text

            # Create a function to get the polarity
        def getPolarity(text):
            return  TextBlob(text).sentiment.polarity

        # Create a function to compute negative (-1), neutral (0) and positive (+1) analysis
        def getAnalysis(score):
            if score < 0:
                return 'Bearish'
            elif score == 0:
                return 'Neutral'
            else:
                return 'Bullish'

        jso = {"Infosys":0,"ACC":0,"ITC":0,"Accenture":0,"TCS":0, "Reliance":0}
        a = "abc"

        while(True):
            import time
            
            for i in range(0,6):
                s = str('#'+arr[i])
                posts=tweepy.Cursor(api.search, q= s, lang ="en", result='recent',tweet_mode="extended").items(1)

                df = pd.DataFrame([tweet.full_text for tweet in posts], columns=['Tweets'])
                #print(df)

                # Clean the tweets
                df['Tweets'] = df['Tweets'].apply(cleanTxt)
                print(df['Tweets'])
                df['Polarity'] = df['Tweets'].apply(getPolarity)

                df['Analysis'] = df['Polarity'].apply(getAnalysis)
                #main[i] = df['Analysis'].to_string(index=False, header=False)
                
                if( i == 0):
                    a = "Infosys"
                    var=df['Analysis'].to_string(index=False, header=False)
                    mycursor.execute("UPDATE social_media_sentiment SET sentiment=(%s) WHERE company_name='Infosys'", (var,))
                    mydb.commit()
                elif(i == 1):
                    a = "ACC"
                    var=df['Analysis'].to_string(index=False, header=False)
                    mycursor.execute("UPDATE social_media_sentiment SET sentiment=(%s) WHERE company_name='ACC'", (var,))
                    mydb.commit()
                elif(i==2):
                    a="ITC"
                    print(df['Tweets'])
                    var=df['Analysis'].to_string(index=False, header=False)
                    mycursor.execute("UPDATE social_media_sentiment SET sentiment=(%s) WHERE company_name='ITC'", (var,))
                    mydb.commit()
                elif(i==3):
                    a="Accenture"
                    var=df['Analysis'].to_string(index=False, header=False)
                    mycursor.execute("UPDATE social_media_sentiment SET sentiment=(%s) WHERE company_name='Accenture'", (var,))
                    mydb.commit()
                elif(i==4):
                    a="TCS"
                    var=df['Analysis'].to_string(index=False, header=False)
                    mycursor.execute("UPDATE social_media_sentiment SET sentiment=(%s) WHERE company_name='TCS'", (var,))
                    mydb.commit()
                elif(i==5):
                    a="Reliance"
                    var=df['Analysis'].to_string(index=False, header=False)
                    mycursor.execute("UPDATE social_media_sentiment SET sentiment=(%s) WHERE company_name='Reliance'", (var,))
                    mydb.commit()


                jso[a] = df['Analysis'].to_string(index=False, header=False)
                print(jso)
                print("Records updated")

            



            
            
            
@app2.route('/')
@app2.route('/get_sentiment', methods=['GET', 'POST'])
def get_sentiment1():
    get_sentiment()
    return "done"

if __name__ == '__main__':
    app2.run(debug=True, host='127.0.0.1', port=5002)