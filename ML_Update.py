import mysql.connector as mysql
import pandas as ps

db_name = "nfl_pass_rush_receive_raw_data"


'''This file takes the values from the database that needs to be predicted, predicts what they need to be, and then updates the database with these values'''
#TODO: Connect to database

db = None #Replace with information to connect with database

cursor = db.cursor()


#TODO: get data to be predicted

player_games = [] #TODO: update to make this have a list of the primary keys to be updated in the database


#Create and train model to predict the games

for player_id, game_id in player_games:
    #TODO: Run ML Model to get predicted values for the 

    predicted_values = None

    #TODO: Convert predicted values into a form that can be read by the query

    #This should be <Column name> = <predicted value>.

    #Then seperate these with commas and by player and game id so this can be read and updated with the db querry.

    cleaned_predicted_values = None
    #TODO: Update database with predicted values


    #NOTE: This could be changed into an insert statement, but I would need to store all data for the predicted game before hand.
    query = '''UPDATE nfl_pass_rush_receive_raw_data
                SET %s
                WHERE game_id = %s, player_id = %s''' % (cleaned_predicted_values, game_id, player_id)

    cursor.execute(query)

db.commit()