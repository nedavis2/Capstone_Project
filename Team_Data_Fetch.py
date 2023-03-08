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


def wide_receiver_targets(team : str):
  pass
def wide_receiver_rec(team : str):
  pass
def wide_receiver_rec_td(team : str):
  pass
def wide_receiver_rec_yds(team : str):
  pass

def tight_end_targets(team : str):
  pass
def tight_end_rec(team : str):
  pass
def tight_end_rec_td(team : str):
  pass
def tight_end_rec_yds(team : str):
  pass

def running_back_rush_td(team : str):
  pass
def running_back_rush_att(team : str):
  pass
def running_back_rush_yds(team : str):
  pass
def running_back_rec_td(team : str):
  pass
def running_back_rec(team : str):
  pass


