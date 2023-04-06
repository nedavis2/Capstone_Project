import sys
import mysql.connector
from mysql.connector import errorcode
from team_data_fetch_test import *


try:

    cnx = mysql.connector.connect(
        user='root', password='', host='localhost', database='capstone_project')
    cursor = cnx.cursor()
    if __name__ == "__main__":
        def some_function():

            player_id, pos = sys.argv[1].split(',')

            print(player_primary_view(player_id, pos))

    some_function()


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
