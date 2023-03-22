import sys
import mysql.connector
from mysql.connector import errorcode



try:
    
    cnx = mysql.connector.connect(user='root', password='', host='localhost', database='capstone_project')
    cursor = cnx.cursor()
    
    if __name__ == "__main__":
        def some_function():
            
            
            newTeam = sys.argv[1].split(',')
            
            
            
            
            query = ("SELECT t_rush_yds FROM `team_table` WHERE team = %s")
            cursor.execute(query,newTeam)
                     
            result = cursor.fetchall()
            final_result = [float(i[0]) for i in result]
            print(final_result)
            #print(newTeam)

        
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









    




