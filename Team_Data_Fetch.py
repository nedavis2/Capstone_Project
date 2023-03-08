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


def player_wide_receiver_targets(player_id : str):
  pass
def player_wide_receiver_rec(player_id : str):
  pass
def player_wide_receiver_rec_td(player_id : str):
  pass
def player_wide_receiver_rec_yds(player_id : str):
  pass

def player_tight_end_targets(player_id : str):
  pass
def player_tight_end_rec(player_id : str):
  pass
def player_tight_end_rec_td(player_id : str):
  pass
def player_tight_end_rec_yds(player_id : str):
  pass

def player_running_back_rush_td(player_id : str):
  pass
def player_running_back_rush_att(player_id : str):
  pass
def player_running_back_rush_yds(player_id : str):
  pass
def player_running_back_rec_td(player_id : str):
  pass
def player_running_back_rec(player_id : str):
  pass

#_________________________________________________
def team_wide_receiver_targets(team : str):
  pass
def team_wide_receiver_rec(team : str):
  pass
def team_wide_receiver_rec_td(team : str):
  pass
def team_wide_receiver_rec_yds(team : str):
  pass

def team_tight_end_targets(team : str):
  pass
def team_tight_end_rec(team : str):
  pass
def team_tight_end_rec_td(team : str):
  pass
def team_tight_end_rec_yds(team : str):
  pass

def team_running_back_rush_td(team : str):
  pass
def team_running_back_rush_att(team : str):
  pass
def team_running_back_rush_yds(team : str):
  pass
def team_running_back_rec_td(team : str):
  pass
def team_running_back_rec(team : str):
  pass
