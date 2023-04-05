import sys
import subprocess
#subprocess.check_call([sys.executable, '-m', 'pip', 'install', 'mysql-connector-python'])
# subprocess.check_call([sys.executable, '-m', 'pip', 'install', 'pandas', '--user'])

import pandas as ps
import datetime
from datetime import date


import mysql
import mysql.connector
from mysql.connector import errorcode

db_name = "capstone_project"
db_host = "localhost"
db_password = ""
db_user = "root"

used_table_name = "nfl_pass_rush_receive_raw_data"
PREDICTION_TABLE_NAME = "prediction" #TODO: Replace with actual prediction table name

RETRIEVE_PLAYER_TOTAL_DATA = 1
RETRIEVE_PLAYER_TIME_DATA = 2
RETRiEVE_TEAM_DATA = 3


def _connect_to_database(db_user = db_user, db_host = db_host, db_password = db_password, db_name = db_name):
    db = mysql.connector.connect(user=db_user, password=db_password, host=db_host, database=db_name)
    cursor = db.cursor()

    return db, cursor
def _end_database_connection(db, cursor):
    db.close()
    cursor.close()

def _retrieve_player_total_data(player_id : str, retreived_data : str, table_name: str, position = None) -> int:
    total = -1
    try:
    
        db, cursor = _connect_to_database()
        query = None
        if position == None:

            query = ''' SELECT SUM(%s) AS total
                        FROM %s
                        WHERE player_id = \"%s\"
            '''%(retreived_data, table_name, player_id)
        else:
            query = ''' SELECT SUM(%s) AS total
                        FROM %s
                        WHERE player_id = \"%s\" AND pos = \"%s\"
            '''%(retreived_data, table_name, player_id, position)
        data = ps.read_sql(query, db)

        total = data["total"]
        
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)
    else:
        _end_database_connection(db, cursor)

    #TODO: Check to make sure that it is ok to return 0 if no data is found.
    if total[0] == None:
        return 0
    return int(total)

def _retrieve_team_total_data(team : str, retreived_data : str, table_name: str) -> int:
    total = -1
    try:
    
        db, cursor = _connect_to_database()
        query =  ''' SELECT SUM(%s) AS total
                        FROM %s
                        WHERE team = \"%s\"
            '''%(retreived_data, table_name, team)
        
        data = ps.read_sql(query, db)

        total = data["total"]
        
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)
    else:
        _end_database_connection(db, cursor)

    #TODO: Check to make sure that it is ok to return 0 if no data is found.
    if total[0] == None:
        return 0
    return int(total)

def get_weekly_or_monthly(weekly = True):
    if weekly:
        return "WEEK"
    else:
        return "MONTH"

#TODO: ask if I should filter by when a player held a certion position.
def _retrieve_player_time_data(player_id : str, retreived_data : str, table_name: str, weekly : bool = True, position = None) -> list[int]:
    data = None
    try:
    
        db, cursor = _connect_to_database()
        query = None

        if position == None:

            query = ''' SELECT SUM(%s) AS value, CONCAT(YEAR(game_date), '/', %s(game_date))  AS date
                        FROM %s
                        WHERE player_id = \"%s\"
                        GROUP BY date ASC
                        ORDER BY date ASC
            '''%(retreived_data, get_weekly_or_monthly(weekly), table_name, player_id)
        else:
            query = ''' SELECT SUM(%s) AS value, CONCAT(YEAR(game_date), '/', %s(game_date))  AS date
                        FROM %s
                        WHERE player_id = \"%s\" AND pos = \"%s\"
                        GROUP BY date ASC
                        ORDER BY date ASC
            '''%(retreived_data,get_weekly_or_monthly(weekly), table_name, player_id, position)

        data = ps.read_sql(query, db)

        

        '''
        #Was for when the date collum held ints
        if weekly:
            data["date"] = data["date"].dt.isocalendar().week
        else:
            data["date"] = data["date"].dt.month
        '''
        #TODO Return values

        
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)

        return [-1]
    else:
        _end_database_connection(db, cursor)
    return data["value"].to_list()

def _retrieve_team_data(team : str,retreived_data : str, table_name: str, weekly : bool = True, position = None) -> list[int]:
    data = None
    try:
    
        db, cursor = _connect_to_database()
        query = ""
        if position == None:

            query = '''SELECT SUM(%s) AS value, CONCAT(YEAR(game_date), '/', %s(game_date))  AS date
                        FROM %s
                        WHERE team = \"%s\"
                        GROUP BY date ASC
                        ORDER BY date ASC
            '''%(retreived_data, get_weekly_or_monthly(weekly), table_name, team)
        else:
            query = ''' SELECT SUM(%s) AS value, CONCAT(YEAR(game_date), '/', %s(game_date))  AS date
                        FROM %s
                        WHERE team = \"%s\" AND pos = \"%s\"
                        GROUP BY date ASC
                        ORDER BY date ASC
            '''%(retreived_data, get_weekly_or_monthly(weekly), table_name, team, position)

        data = ps.read_sql(query, db)

        #data["date"] = ps.to_datetime(data["date"])

        '''
        #Old code, from when this returned an int
        if weekly:
            data["date"] = data["date"].dt.isocalendar().week
        else:
            data["date"] = data["date"].dt.month
        '''
        #TODO Return values

        
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)

        return [-1]
    else:
        _end_database_connection(db, cursor)
    #print(data["value"].to_list())
    #print(data["date"].to_list())

    return data["value"].to_list()

def get_player_dates(player_id : str, weekly = True):
    data = None
    player_table = "nfl_pass_rush_receive_raw_data" #TODO: Change to new table after table spliting
    try:
    
        db, cursor = _connect_to_database()
        query = ""

        
        query = ''' SELECT DISTINCT game_date AS date
                    FROM %s
                    WHERE player_id = "%s"
                    GROUP BY CONCAT(YEAR(game_date), '/', %s(game_date))
                    ORDER BY date ASC
        '''%(player_table, player_id, get_weekly_or_monthly(weekly))

        data = ps.read_sql(query, db)
        
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)

        return [-1]
    else:
        _end_database_connection(db, cursor)
    #print(data["value"].to_list())
    #print(data["date"].to_list())

    return data["date"].to_list()

def get_team_dates(team_id : str, weekly = True):
    data = None
    team_table = "nfl_pass_rush_receive_raw_data" #TODO: Change to new table after table spliting
    try:
    
        db, cursor = _connect_to_database()
        
        query = ''' SELECT DISTINCT game_date AS date
                    FROM %s
                    WHERE team = "%s"
                    GROUP BY CONCAT(YEAR(game_date), '/', %s(game_date))
                    ORDER BY date ASC
        '''%(team_table, team_id, get_weekly_or_monthly(weekly))

        data = ps.read_sql(query, db)
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)

        return [-1]
    else:
        _end_database_connection(db, cursor)
    #print(data["value"].to_list())
    #print(data["date"].to_list())

    return data["date"].to_list()
#NOTE: Seperate data into weeks.
#result includes gamedate + stat for weekly/monthly data
#directly interact with database



def _get_player_prediction_value(player_id : str,retreived_data : str, table_name: str = PREDICTION_TABLE_NAME):

    print("NOTE: The prediction table needs to be implemented before this function can be used.")
    return 0
    data = -1
    try:
    
        db, cursor = _connect_to_database()
        query =  ''' SELECT * AS data
                        FROM %s
                        WHERE player_id = \"%s\"
            '''%(table_name, player_id)
        
        data = ps.read_sql(query, db)

        output = data[retreived_data]
        
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)
    else:
        _end_database_connection(db, cursor)

    #TODO: Check to make sure that it is ok to return 0 if no data is found.
    if output[0] == None:
        return 0
    return int(output[retreived_data])




def get_team_weeks(team_id : str):
    return get_team_dates(team_id, weekly = True)
   
def get_team_months(team_id : str):
    return get_team_dates(team_id, weekly=False)

def get_player_weeks(player_id : str):
    return get_player_dates(player_id, weekly = True)

def get_player_months(player_id : str):
    return get_player_dates(player_id, weekly = False)



#TODO: Ask if I need to change the functions for various positions.
def player_wide_receiver_targets_total(player_id : str) -> int:
  '''
  person picks player from home screen, call this function, returns total of the stats and the targets broken down by week, and by month
  '''
  pass
def player_wide_receiver_rec_total(player_id : str) -> int:

    retreived_data = "rec"
    position = "WR"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)
def player_wide_receiver_rec_td_total(player_id : str) -> int:
    retreived_data = "rec_td"
    position = "WR"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)
def player_wide_receiver_rec_yds_total(player_id : str) -> int:
    retreived_data = "rec_yds"
    position = "WR"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)

def player_tight_end_targets_total(player_id : str) -> int:
    retreived_data = "targets"
    position = "TE"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position) 

def player_tight_end_rec_total(player_id : str) -> int:
    retreived_data = "rec"
    position = "TE"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)

def player_tight_end_rec_td_total(player_id : str) -> int:
    retreived_data = "rec_td"
    position = "TE"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)

def player_tight_end_rec_yds_total(player_id : str) -> int:
    retreived_data = "rec_yds"
    position = "TE"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)

def player_running_back_rush_td_total(player_id : str) -> int:
    retreived_data = "rush_td"
    position = "RB"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)

def player_running_back_rush_att_total(player_id : str) -> int:
    retreived_data = "rush_att"
    position = "RB"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)

def player_running_back_rush_yds_total(player_id : str) -> int:
    retreived_data = "rush_yds"
    position = "RB"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)

def player_running_back_rec_td_total(player_id : str) -> int:
    retreived_data = "rec_td"
    position = "RB"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)

def player_running_back_rec_total(player_id : str) -> int:
    retreived_data = "rec"
    position = "RB"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)


#________________________________________

#week
def player_wide_receiver_targets_weekly(player_id : str) -> list[int]:
  '''
  person picks player from home screen, call this function, returns total of the stats and the targets broken down by week, and by month
  '''

  retreived_data = "targets"
  position = "WR"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)

def player_wide_receiver_rec_weekly(player_id : str) -> list[int]:
    retreived_data = "rec"
    position = "WR"
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)

def player_wide_receiver_rec_td_weekly(player_id : str) -> list[int]:
  retreived_data = "rec_td"
  position = "WR"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)

def player_wide_receiver_rec_yds_weekly(player_id : str) -> list[int]:
  retreived_data = "rec_yds"
  position = "WR"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)


def player_tight_end_targets_weekly(player_id : str) -> list[int]:
  retreived_data = "targets"
  position = "TE"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)

def player_tight_end_rec_weekly(player_id : str) -> list[int]:
  retreived_data = "rec"
  position = "TE"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)

def player_tight_end_rec_td_weekly(player_id : str) -> list[int]:
  retreived_data = "rec_td"
  position = "TE"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)

def player_tight_end_rec_yds_weekly(player_id : str) -> list[int]:
  retreived_data = "rec_yds"
  position = "TE"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)


def player_running_back_rush_td_weekly(player_id : str) -> list[int]:
  retreived_data = "rush_td"
  position = "RB"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)

def player_running_back_rush_att_weekly(player_id : str) -> list[int]:
  retreived_data = "rush_att"
  position = "RB"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)

def player_running_back_rush_yds_weekly(player_id : str) -> list[int]:
  retreived_data = "rush_yds"
  position = "RB"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)

def player_running_back_rec_td_weekly(player_id : str) -> list[int]:
  retreived_data = "rec_td"
  position = "RB"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)

def player_running_back_rec_weekly(player_id : str) -> list[int]:
  retreived_data = "rec"
  position = "RB"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)


#________________________________________

#month
def player_wide_receiver_targets_monthly(player_id : str) -> list[int]:
    '''
    person picks player from home screen, call this function, returns total of the stats and the targets broken down by week, and by month
    '''
    retreived_data = "targets"
    position = "WR"
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)

def player_wide_receiver_rec_monthly(player_id : str) -> list[int]:
    retreived_data = "rec"
    position = "WR"
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)

def player_wide_receiver_rec_td_monthly(player_id : str) -> list[int]:
    retreived_data = "rec_td"
    position = "WR"
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)

def player_wide_receiver_rec_yds_monthly(player_id : str) -> list[int]:
    retreived_data = "rec_yds"
    position = "WR"
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)

def player_tight_end_targets_monthly(player_id : str) -> list[int]:
    retreived_data = "targets"
    position = "TE"
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)
def player_tight_end_rec_monthly(player_id : str) -> list[int]:
    retreived_data = "rec"
    position = "TE"
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)
def player_tight_end_rec_td_monthly(player_id : str) -> list[int]:
    retreived_data = "rec_td"
    position = "TE"
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)
def player_tight_end_rec_yds_monthly(player_id : str) -> list[int]:
    retreived_data = "rec_yds"
    position = "TE"
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)

def player_running_back_rush_td_monthly(player_id : str) -> list[int]:
    retreived_data = "rush_td"
    position = "RB"
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)
def player_running_back_rush_att_monthly(player_id : str) -> list[int]:
    retreived_data = "rush_att"
    position = "RB"
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)
def player_running_back_rush_yds_monthly(player_id : str) -> list[int]:
    retreived_data = "rush_yds"
    position = "RB"
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)
def player_running_back_rec_td_monthly(player_id : str) -> list[int]:
    retreived_data = "rec_td"
    position = "RB"
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)
def player_running_back_rec_monthly(player_id : str) -> list[int]:
    retreived_data = "rec"
    position = "RB"
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)


#team
#________________________________________

#week
def team_wide_receiver_targets_weekly(team : str) -> list[int]:
    retreived_data = "targets"
    position = "WR"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True, position = position)

def team_wide_receiver_rec_weekly(team : str) -> list[int]:
    retreived_data = "rec"
    position = "WR"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True, position = position)
def team_wide_receiver_rec_td_weekly(team : str) -> list[int]:
    retreived_data = "rec_td"
    position = "WR"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True, position = position)
def team_wide_receiver_rec_yds_weekly(team : str) -> list[int]:
    retreived_data = "rec_yds"
    position = "WR"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True, position = position)

def team_tight_end_targets_weekly(team : str) -> list[int]:
    retreived_data = "targets"
    position = "TE"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True, position = position)
def team_tight_end_rec_weekly(team : str) -> list[int]:
    retreived_data = "rec"
    position = "TE"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True, position = position)
def team_tight_end_rec_td_weekly(team : str) -> list[int]:
    retreived_data = "rec_td"
    position = "TE"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True, position = position)
def team_tight_end_rec_yds_weekly(team : str) -> list[int]:
    retreived_data = "rec_yds"
    position = "TE"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True, position = position)

def team_running_back_rush_td_weekly(team : str) -> list[int]:
    retreived_data = "rush_td"
    position = "RB"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True, position = position)
def team_running_back_rush_att_weekly(team : str) -> list[int]:
    retreived_data = "rush_att"
    position = "RB"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True, position = position)
def team_running_back_rush_yds_weekly(team : str) -> list[int]:
    retreived_data = "rush_yds"
    position = "RB"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True, position = position)
def team_running_back_rec_td_weekly(team : str) -> list[int]:
    retreived_data = "rec_td"
    position = "RB"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True, position = position)
def team_running_back_rec_weekly(team : str) -> list[int]:
    retreived_data = "rec"
    position = "RB"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True, position = position)
#month
def team_wide_receiver_targets_monthly(team : str) -> list[int]:
    retreived_data = "targets"
    position = "WR"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False, position = position)
def team_wide_receiver_rec_monthly(team : str) -> list[int]:
    retreived_data = "rec"
    position = "WR"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False, position = position)
def team_wide_receiver_rec_td_monthly(team : str) -> list[int]:
    retreived_data = "rec_td"
    position = "WR"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False, position = position)
def team_wide_receiver_rec_yds_monthly(team : str) -> list[int]:
    retreived_data = "rec_yds"
    position = "WR"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False, position = position)

def team_tight_end_targets_monthly(team : str) -> list[int]:
    retreived_data = "targets"
    position = "TE"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False, position = position)
def team_tight_end_rec_monthly(team : str) -> list[int]:
    retreived_data = "rec"
    position = "TE"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False, position = position)
def team_tight_end_rec_td_monthly(team : str) -> list[int]:
    retreived_data = "rec_td"
    position = "TE"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False, position = position)
def team_tight_end_rec_yds_monthly(team : str) -> list[int]:
    retreived_data = "rec_yds"
    position = "TE"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False, position = position)

def team_running_back_rush_td_monthly(team : str) -> list[int]:
    retreived_data = "rush_td"
    position = "RB"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False, position = position)
def team_running_back_rush_att_monthly(team : str) -> list[int]:
    retreived_data = "rush_att"
    position = "RB"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False, position = position)
def team_running_back_rush_yds_monthly(team : str) -> list[int]:
    retreived_data = "rush_yds"
    position = "RB"
    return  _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False, position = position)
def team_running_back_rec_td_monthly(team : str) -> list[int]:
    retreived_data = "rec_td"
    position = "RB"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False, position = position)
def team_running_back_rec_monthly(team : str) -> list[int]:
    retreived_data = "rec"
    position = "RB"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False, position = position)
#TODO get team rb rec, trgts, rec yds, and rec tds in separate columns
# def team_running_back_rec_td_total(team : str) -> list[int]:
    #retreived_data = "rec_td"
    #position = "RB"
    #return _retrieve_team_total_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False, position = position)
#def team_running_back_rec_total(team : str) -> list[int]:
    #retreived_data = "rec"
    #position = "RB"
    #return _retrieve_team_total_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False, position = position)



#No position values

#________________________________________________________________________________
def player_rush_td_total(player_id : str) -> int:
    retreived_data = "rush_td"
    
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name)

def player_rush_att_total(player_id : str) -> int:
    retreived_data = "rush_att"
    
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name)

def player_rush_yds_total(player_id : str) -> int:
    retreived_data = "rush_yds"
    
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name)

def player_targets_total(player_id : str) -> int:
    retreived_data = 'targets'
    
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name)

def player_rec_td_total(player_id : str) -> int:
    retreived_data = "rec_td"
    
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name)

def player_rec_total(player_id : str) -> int:
    retreived_data = "rec"
    
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name)

def player_rec_yds_total(player_id : str) -> int:
    retreived_data = "rec_yds"
    
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name)


def player_rush_td_weekly(player_id : str) -> list[int]:
  retreived_data = "rush_td"
  
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True)

def player_rush_att_weekly(player_id : str) -> list[int]:
  retreived_data = "rush_att"
  
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True)

def player_rush_yds_weekly(player_id : str) -> list[int]:
  retreived_data = "rush_yds"
  
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True)

def player_targets_weekly(player_id : str) -> list[int]:
  retreived_data = 'targets'
  
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True)
def player_rec_td_weekly(player_id : str) -> list[int]:
  retreived_data = "rec_td"
  
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True)

def player_rec_weekly(player_id : str) -> list[int]:
  retreived_data = "rec"
  
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True)

def player_rec_yds_weekly(player_id : str) -> list[int]:
  retreived_data = "rec_yds"
  
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True)

def player_rush_td_monthly(player_id : str) -> list[int]:
    retreived_data = "rush_td"
    
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False)

def player_rush_att_monthly(player_id : str) -> list[int]:
    retreived_data = "rush_att"
    
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False)

def player_rush_yds_monthly(player_id : str) -> list[int]:
    retreived_data = "rush_yds"
    
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False)

def player_targets_monthly(player_id : str) -> list[int]:
    retreived_data = 'targets'
    
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False)

def player_rec_td_monthly(player_id : str) -> list[int]:
    retreived_data = "rec_td"
    
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False)

def player_rec_monthly(player_id : str) -> list[int]:
    retreived_data = "rec"
    
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False)

def player_rec_yds_monthly(player_id : str) -> list[int]:
    retreived_data = "rec_yds"
    
    return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False)


def team_pass_att_weekly(team : str) -> list[int]:
    retreived_data = "pass_att"

    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True)

def team_pass_cmp_weekly(team : str) -> list[int]:
    retreived_data = "pass_cmp"

    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True)

def team_pass_yds_weekly(team : str) -> list[int]:
    retreived_data = "pass_yds"

    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True)

def team_pass_td_weekly(team : str) -> list[int]:
    retreived_data = "pass_td"

    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True)

def team_rush_td_weekly(team : str) -> list[int]:
    retreived_data = "rush_td"
    
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True)

def team_rush_att_weekly(team : str) -> list[int]:
    retreived_data = "rush_att"
    
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True)

def team_rush_yds_weekly(team : str) -> list[int]:
    retreived_data = "rush_yds"
    
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True)

def team_targets_weekly(team : str) -> list[int]:
    retreived_data = "targets"
    
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True)

def team_rec_td_weekly(team : str) -> list[int]:
    retreived_data = "rec_td"
    
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True)

def team_rec_weekly(team : str) -> list[int]:
    retreived_data = "rec"
    
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True)

def team_rec_yds_weekly(team : str) -> list[int]:
    retreived_data = "rec_yds"
    
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True)


def team_pass_att_monthly(team : str) -> list[int]:
    retreived_data = "pass_att"

    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False)

def team_pass_cmp_monthly(team : str) -> list[int]:
    retreived_data = "pass_cmp"

    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False)

def team_pass_yds_monthly(team : str) -> list[int]:
    retreived_data = "pass_yds"

    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False)

def team_pass_td_monthly(team : str) -> list[int]:
    retreived_data = "pass_td"

    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False)

def team_rush_td_monthly(team : str) -> list[int]:
    retreived_data = "rush_td"
    
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False)

def team_rush_att_monthly(team : str) -> list[int]:
    retreived_data = "rush_att"
    
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False)

def team_rush_yds_monthly(team : str) -> list[int]:
    retreived_data = "rush_yds"
    
    return  _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False)

def team_targets_monthly(team : str) -> list[int]:
    retreived_data = "targets"
    
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False)

def team_rec_td_monthly(team : str) -> list[int]:
    retreived_data = "rec_td"
    
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False)

def team_rec_monthly(team : str) -> list[int]:
    retreived_data = "rec"
    
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False)

def team_rec_yds_monthly(team : str) -> list[int]:
    retreived_data = "rec_yds"
    
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = False)


def team_pass_att_total(team : str) -> list[int]:
    retreived_data = "pass_att"

    return _retrieve_team_total_data(team,retreived_data = retreived_data, table_name = used_table_name)

def team_pass_cmp_total(team : str) -> list[int]:
    retreived_data = "pass_cmp"

    return _retrieve_team_total_data(team,retreived_data = retreived_data, table_name = used_table_name)

def team_pass_yds_total(team : str) -> list[int]:
    retreived_data = "pass_yds"

    return _retrieve_team_total_data(team,retreived_data = retreived_data, table_name = used_table_name)

def team_pass_td_total(team : str) -> list[int]:
    retreived_data = "pass_td"

    return _retrieve_team_total_data(team,retreived_data = retreived_data, table_name = used_table_name)

def team_rush_td_total(team : str) -> list[int]:
    retreived_data = "rush_td"

    return _retrieve_team_total_data(team,retreived_data = retreived_data, table_name = used_table_name)

def team_rush_att_total(team : str) -> list[int]:
    retreived_data = "rush_att"

    return _retrieve_team_total_data(team,retreived_data = retreived_data, table_name = used_table_name)

def team_rush_yds_total(team : str) -> list[int]:
    retreived_data = "rush_yds"

    return _retrieve_team_total_data(team,retreived_data = retreived_data, table_name = used_table_name)

def team_targets_total(team : str) -> list[int]:
    retreived_data = "targets"

    return _retrieve_team_total_data(team,retreived_data = retreived_data, table_name = used_table_name)

def team_rec_td_total(team : str) -> list[int]:
    retreived_data = "rec_td"

    return _retrieve_team_total_data(team,retreived_data = retreived_data, table_name = used_table_name)

def team_rec_total(team : str) -> list[int]:
    retreived_data = "rec"

    return _retrieve_team_total_data(team,retreived_data = retreived_data, table_name = used_table_name)

def team_rec_yds_total(team : str) -> list[int]:
    retreived_data = "rec_yds"

    return _retrieve_team_total_data(team,retreived_data = retreived_data, table_name = used_table_name)

def player_quarterback_pass_att_weekly(player_id : str) -> list[int]:
  retreived_data = "pass_att"
  position = "QB"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)

def player_quarterback_pass_att_monthly(player_id : str) -> list[int]:
  retreived_data = "pass_att"
  position = "QB"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)

def player_quarterback_pass_att_total(player_id : str) -> int:
    retreived_data = "pass_att"
    position = "QB"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)
def player_quarterback_pass_cmp_weekly(player_id : str) -> list[int]:
  retreived_data = "pass_cmp"
  position = "QB"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)

def player_quarterback_pass_cmp_monthly(player_id : str) -> list[int]:
  retreived_data = "pass_cmp"
  position = "QB"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)

def player_quarterback_pass_cmp_total(player_id : str) -> int:
    retreived_data = "pass_cmp"
    position = "QB"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)
def player_quarterback_pass_yds_weekly(player_id : str) -> list[int]:
  retreived_data = "pass_yds"
  position = "QB"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)

def player_quarterback_pass_yds_monthly(player_id : str) -> list[int]:
  retreived_data = "pass_yds"
  position = "QB"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)

def player_quarterback_pass_yds_total(player_id : str) -> int:
    retreived_data = "pass_yds"
    position = "QB"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)
def player_quarterback_pass_td_weekly(player_id : str) -> list[int]:
  retreived_data = "pass_td"
  position = "QB"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)

def player_quarterback_pass_td_monthly(player_id : str) -> list[int]:
  retreived_data = "pass_td"
  position = "QB"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)

def player_quarterback_pass_td_total(player_id : str) -> int:
    retreived_data = "pass_td"
    position = "QB"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)



print(get_player_weeks("RodgAa00"))
print(get_player_months("RodgAa00"))

print("_____________________________________")

print(get_team_weeks("GNB"))
print(get_team_months("GNB"))