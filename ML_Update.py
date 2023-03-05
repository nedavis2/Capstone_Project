import mysql.connector as mysql
import pandas as ps

import sys
import subprocess
subprocess.check_call([sys.executable, '-m', 'pip', 'install', 'mysql-connector-python'])

import mysql.connector
from mysql.connector import errorcode

db_name = "capstone_project"
db_host = "localhost"
db_password = ""
db_user = "root"

'''This file takes the values from the database that needs to be predicted, predicts what they need to be, and then updates the database with these values'''
#TODO: Connect to database

try:
    db = mysql.connector.connect(user=db_user, password=db_password, host=db_host, database=db_name)
    cursor = db.cursor()


    #TODO: get data to be predicted

    player_games = [] #TODO: update to make this have a list of the primary keys to be updated in the database


    #Create and train model to predict the games

    for player_id, game_id in player_games:
        #TODO: Run ML Model to get predicted values for the 

        predicted_values = None

        #TODO: Convert predicted values into a form that can be read by the query

        #This should be <Column name> = <predicted value>.

        #NOTE: Change to db_name (col_1_val, col_2_val, ...) and (val_1, val2, ...) 

        #TODO: Once changing to INSERT INTO, all data for the row needs to be added. It also needs to be formated for an insert statement

        #Then seperate these with commas and by player and game id so this can be read and updated with the db querry.

        cleaned_predicted_values = None
        #TODO: Update database with predicted values


        #NOTE: This could be changed into an insert statement, but I would need to store all data for the predicted game before hand.
        #TODO: Change this to an INSERT INTO statement with all data for a new entry.

        '''
        New formmating after change (from https://www.w3schools.com/mysql/mysql_insert.asp):
        INSERT INTO table_name (column1, column2, column3, ...)
        VALUES (value1, value2, value3, ...);
        '''
        query = '''UPDATE %s
                    SET %s
                    WHERE game_id = %s, player_id = %s''' % (db_name, cleaned_predicted_values, game_id, player_id)

        cursor.execute(query)

    db.commit()
except mysql.connector.Error as err:
  if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
    print("Something is wrong with your user name or password")
  elif err.errno == errorcode.ER_BAD_DB_ERROR:
    print("Database does not exist")
  else:
    print(err)
else:

  cnx.close()
  cursor.close()
