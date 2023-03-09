import mysql
import pandas as ps
import datetime
from datetime import date
import sys
import subprocess
subprocess.check_call([sys.executable, '-m', 'pip', 'install', 'mysql-connector-python'])

import mysql.connector
from mysql.connector import errorcode

db_name = "capstone_project"
db_host = "localhost"
db_password = ""
db_user = "root"

def _connect_to_database(db_user = db_user, db_host = db_host, db_password = db_password, db_name = db_name):
    db = mysql.connector.connect(user=db_user, password=db_password, host=db_host, database=db_name)
    cursor = db.cursor()

    return db, cursor
def _end_database_connection(db, cursor):
    db.close()
    cursor.close()

def _retrieve_player_total_data(player_id : str, retreived_data : str, table_name: str) -> int:
    try:
    
        db, cursor = _connect_to_database()

        query = ''' SELECT SUM(%s) AS total
                    FROM %s
                    WHERE player_id = \"%s\"
        '''%(retreived_data, table_name, player_id)

        data = ps.read_sql(query, db)

        total = data["total"]
        return int(total)
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)
    else:
        _end_database_connection(db, cursor)

def _retrieve_player_time_data(player_id : str, retreived_data : str, table_name: str, weekly : bool = True) -> tuple((list[int], list[date])):
    try:
    
        db, cursor = _connect_to_database()

        query = ''' SELECT %s AS value, game_date AS date
                    FROM %s
                    WHERE player_id = \"%s\"
        '''%(retreived_data, table_name, player_id)

        data = ps.read_sql(query, db)

        data["date"] = ps.to_datetime(data["date"])

        if weekly:
            data["date"] = data["date"].dt.isocalendar().week
        else:
            data["date"] = data["date"].dt.month
        #TODO Return values

        return data["value"].to_list(), data["date"].to_list()
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)
    else:
        _end_database_connection(db, cursor)


def _retrieve_team_data(team : str,retreived_data : str, table_name: str, weekly : bool = True) -> tuple((list[int], list[date])):
    try:
    
        db, cursor = _connect_to_database()

        query = ''' SELECT %s AS value, game_date AS date
                    FROM %s
                    WHERE team = \"%s\"
        '''%(retreived_data, table_name, team)

        data = ps.read_sql(query, db)

        data["date"] = ps.to_datetime(data["date"])

        if weekly:
            data["date"] = data["date"].dt.isocalendar().week
        else:
            data["date"] = data["date"].dt.month
        #TODO Return values

        return data["value"].to_list(), data["date"].to_list()
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)
    else:
        _end_database_connection(db, cursor)



#NOTE: Seperate data into weeks.
#result includes gamedate + stat for weekly/monthly data
#directly interact with database
def player_wide_receiver_targets_total(player_id : str) -> int:
  '''
  person picks player from home screen, call this function, returns total of the stats and the targets broken down by week, and by month
  '''
  pass
def player_wide_receiver_rec_total(player_id : str) -> int:
  pass
def player_wide_receiver_rec_td_total(player_id : str) -> int:
  pass
def player_wide_receiver_rec_yds_total(player_id : str) -> int:
  pass

def player_tight_end_targets_total(player_id : str) -> int:
  pass
def player_tight_end_rec_total(player_id : str) -> int:
  pass
def player_tight_end_rec_tdc_total(player_id : str) -> int:
  pass
def player_tight_end_rec_ydsc_total(player_id : str) -> int:
  pass

def player_running_back_rush_tdc_total(player_id : str) -> int:
  pass
def player_running_back_rush_attc_total(player_id : str) -> int:
  pass
def player_running_back_rush_ydsc_total(player_id : str) -> int:
  pass
def player_running_back_rec_tdc_total(player_id : str) -> int:
  pass
def player_running_back_recc_total(player_id : str) -> int:
  pass

#________________________________________

#week
def player_wide_receiver_targets_weekly(player_id : str) -> tuple((list[int], list[date])):
  '''
  person picks player from home screen, call this function, returns total of the stats and the targets broken down by week, and by month
  '''
  pass
def player_wide_receiver_rec_weekly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_wide_receiver_rec_td_weekly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_wide_receiver_rec_yds_weekly(player_id : str) -> tuple((list[int], list[date])):
  pass

def player_tight_end_targets_weekly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_tight_end_rec_weekly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_tight_end_rec_td_weekly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_tight_end_rec_yds_weekly(player_id : str) -> tuple((list[int], list[date])):
  pass

def player_running_back_rush_td_weekly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_running_back_rush_att_weekly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_running_back_rush_yds_weekly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_running_back_rec_td_weekly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_running_back_rec_weekly(player_id : str) -> tuple((list[int], list[date])):
  pass

#________________________________________

#month
def player_wide_receiver_targets_monthly(player_id : str) -> tuple((list[int], list[date])):
  '''
  person picks player from home screen, call this function, returns total of the stats and the targets broken down by week, and by month
  '''
  pass
def player_wide_receiver_rec_monthly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_wide_receiver_rec_td_monthly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_wide_receiver_rec_yds_monthly(player_id : str) -> tuple((list[int], list[date])):
  pass

def player_tight_end_targets_monthly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_tight_end_rec_monthly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_tight_end_rec_td_monthly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_tight_end_rec_yds_monthly(player_id : str) -> tuple((list[int], list[date])):
  pass

def player_running_back_rush_td_monthly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_running_back_rush_att_monthly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_running_back_rush_yds_monthly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_running_back_rec_td_monthly(player_id : str) -> tuple((list[int], list[date])):
  pass
def player_running_back_rec_monthly(player_id : str) -> tuple((list[int], list[date])):
  pass

#________________________________________

#week
def team_wide_receiver_targets_weekly(team : str) -> tuple((list[int], list[date])):
  pass
def team_wide_receiver_rec_weekly(team : str) -> tuple((list[int], list[date])):
  pass
def team_wide_receiver_rec_td_weekly(team : str) -> tuple((list[int], list[date])):
  pass
def team_wide_receiver_rec_yds_weekly(team : str) -> tuple((list[int], list[date])):
  pass

def team_tight_end_targets_weekly(team : str) -> tuple((list[int], list[date])):
  pass
def team_tight_end_rec_weekly(team : str) -> tuple((list[int], list[date])):
  pass
def team_tight_end_rec_td_weekly(team : str) -> tuple((list[int], list[date])):
  pass
def team_tight_end_rec_yds_weekly(team : str) -> tuple((list[int], list[date])):
  pass

def team_running_back_rush_td_weekly(team : str) -> tuple((list[int], list[date])):
  pass
def team_running_back_rush_att_weekly(team : str) -> tuple((list[int], list[date])):
  pass
def team_running_back_rush_yds_weekly(team : str) -> tuple((list[int], list[date])):
  pass
def team_running_back_rec_td_weekly(team : str) -> tuple((list[int], list[date])):
  pass
def team_running_back_rec_weekly(team : str) -> tuple((list[int], list[date])):
    pass
#month
def team_wide_receiver_targets_monthly(team : str) -> tuple((list[int], list[date])):
  pass
def team_wide_receiver_rec_monthly(team : str) -> tuple((list[int], list[date])):
  pass
def team_wide_receiver_rec_td_monthly(team : str) -> tuple((list[int], list[date])):
  pass
def team_wide_receiver_rec_yds_monthly(team : str) -> tuple((list[int], list[date])):
  pass

def team_tight_end_targets_monthly(team : str) -> tuple((list[int], list[date])):
  pass
def team_tight_end_rec_monthly(team : str) -> tuple((list[int], list[date])):
  pass
def team_tight_end_rec_td_monthly(team : str) -> tuple((list[int], list[date])):
  pass
def team_tight_end_rec_yds_monthly(team : str) -> tuple((list[int], list[date])):
  pass

def team_running_back_rush_td_monthly(team : str) -> tuple((list[int], list[date])):
  pass
def team_running_back_rush_att_monthly(team : str) -> tuple((list[int], list[date])):
  pass
def team_running_back_rush_yds_monthly(team : str) -> tuple((list[int], list[date])):
  pass
def team_running_back_rec_td_monthly(team : str) -> tuple((list[int], list[date])):
  pass
def team_running_back_rec_monthly(team : str) -> tuple((list[int], list[date])):
  pass



#Testing function

print(_retrieve_team_data("MIN", "pass_cmp", "nfl_pass_rush_receive_raw_data", False))