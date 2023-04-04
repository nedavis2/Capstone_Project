import sys
import mysql.connector
from mysql.connector import errorcode
from team_data_fetch_test import *

if __name__ == "__main__":
       def some_function():

            player_id, pos = sys.argv[1].split(',')
            
            print(player_primary_view(player_id, pos))

some_function()
