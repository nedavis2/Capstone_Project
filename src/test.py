import json
import sys
import subprocess
import mysql.connector
from mysql.connector import errorcode


subprocess.check_call([sys.executable, '-m', 'pip', 'install', 'mysql-connector-python'])


try:
    
    cnx = mysql.connector.connect(user='root', password='', host='localhost', database='capstone_project')
    cursor = cnx.cursor()
    
    if __name__ == "__main__":
        def some_function():
            newPlayer = sys.argv[1].split(',')
        
            #Our operations go here
        
            #result="Some calculations based on " + player
            
            query = ("SELECT player, team, SUM(rec) AS sumRec, SUM(pass_cmp) AS sumPassCmp, SUM(pass_att) AS sumPassAtt " 
                     + "FROM nfl_pass_rush_receive_raw_data WHERE player = %s")
            cursor.execute(query, newPlayer)
            
            for (player, team, sumRec, sumPassCmp, sumPassAtt) in cursor:
                print("{}, {}, {}, {}, {}".format(player, team, sumRec, sumPassCmp, sumPassAtt))
        
        some_function()
            #print(result)

    #Your code goes between here
    #query = ("SELECT player, team, SUM(rec) AS sumRec FROM nfl_pass_rush_receive_raw_data WHERE player = 'a.j. brown'")

    #cursor.execute(query, ())

    #for (player, team, sumRec) in cursor:
    #    print("{}, {}, {}".format(
    #        player, team, sumRec))

    #and here
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









    