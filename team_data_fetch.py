import mysql
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
def player_wide_receiver_targets_weekly(player_id : str) -> int[]:
  '''
  person picks player from home screen, call this function, returns total of the stats and the targets broken down by week, and by month
  '''
  pass
def player_wide_receiver_rec_weekly(player_id : str) -> int[]:
  pass
def player_wide_receiver_rec_td_weekly(player_id : str) -> int[]:
  pass
def player_wide_receiver_rec_yds_weekly(player_id : str) -> int[]:
  pass

def player_tight_end_targets_weekly(player_id : str) -> int[]:
  pass
def player_tight_end_rec_weekly(player_id : str) -> int[]:
  pass
def player_tight_end_rec_td_weekly(player_id : str) -> int[]:
  pass
def player_tight_end_rec_yds_weekly(player_id : str) -> int[]:
  pass

def player_running_back_rush_td_weekly(player_id : str) -> int[]:
  pass
def player_running_back_rush_att_weekly(player_id : str) -> int[]:
  pass
def player_running_back_rush_yds_weekly(player_id : str) -> int[]:
  pass
def player_running_back_rec_td_weekly(player_id : str) -> int[]:
  pass
def player_running_back_rec_weekly(player_id : str) -> int[]:
  pass

#________________________________________

#month
def player_wide_receiver_targets_monthly(player_id : str) -> int[]:
  '''
  person picks player from home screen, call this function, returns total of the stats and the targets broken down by week, and by month
  '''
  pass
def player_wide_receiver_rec_monthly(player_id : str) -> int[]:
  pass
def player_wide_receiver_rec_td_monthly(player_id : str) -> int[]:
  pass
def player_wide_receiver_rec_yds_monthly(player_id : str) -> int[]:
  pass

def player_tight_end_targets_monthly(player_id : str) -> int[]:
  pass
def player_tight_end_rec_monthly(player_id : str) -> int[]:
  pass
def player_tight_end_rec_td_monthly(player_id : str) -> int[]:
  pass
def player_tight_end_rec_yds_monthly(player_id : str) -> int[]:
  pass

def player_running_back_rush_td_monthly(player_id : str) -> int[]:
  pass
def player_running_back_rush_att_monthly(player_id : str) -> int[]:
  pass
def player_running_back_rush_yds_monthly(player_id : str) -> int[]:
  pass
def player_running_back_rec_td_monthly(player_id : str) -> int[]:
  pass
def player_running_back_rec_monthly(player_id : str) -> int[]:
  pass

#________________________________________

#week
def team_wide_receiver_targets_weekly(team : str) -> int[]:
  pass
def team_wide_receiver_rec_weekly(team : str) -> int[]:
  pass
def team_wide_receiver_rec_td_weekly(team : str) -> int[]:
  pass
def team_wide_receiver_rec_yds_weekly(team : str) -> int[]:
  pass

def team_tight_end_targets_weekly(team : str) -> int[]:
  pass
def team_tight_end_rec_weekly(team : str) -> int[]:
  pass
def team_tight_end_rec_td_weekly(team : str) -> int[]:
  pass
def team_tight_end_rec_yds_weekly(team : str) -> int[]:
  pass

def team_running_back_rush_td_weekly(team : str) -> int[]:
  pass
def team_running_back_rush_att_weekly(team : str) -> int[]:
  pass
def team_running_back_rush_yds_weekly(team : str) -> int[]:
  pass
def team_running_back_rec_td_weekly(team : str) -> int[]:
  pass
def team_running_back_rec_weekly(team : str) -> int[]:
  pass

#month
def team_wide_receiver_targets_monthly(team : str) -> int[]:
  pass
def team_wide_receiver_rec_monthly(team : str) -> int[]:
  pass
def team_wide_receiver_rec_td_monthly(team : str) -> int[]:
  pass
def team_wide_receiver_rec_yds_monthly(team : str) -> int[]:
  pass

def team_tight_end_targets_monthly(team : str) -> int[]:
  pass
def team_tight_end_rec_monthly(team : str) -> int[]:
  pass
def team_tight_end_rec_td_monthly(team : str) -> int[]:
  pass
def team_tight_end_rec_yds_monthly(team : str) -> int[]:
  pass

def team_running_back_rush_td_monthly(team : str) -> int[]:
  pass
def team_running_back_rush_att_monthly(team : str) -> int[]:
  pass
def team_running_back_rush_yds_monthly(team : str) -> int[]:
  pass
def team_running_back_rec_td_monthly(team : str) -> int[]:
  pass
def team_running_back_rec_monthly(team : str) -> int[]:
  pass
