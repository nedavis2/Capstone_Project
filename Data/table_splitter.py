# import neccesary modules
import pandas as pd
import os

# read in the main data source
data = pd.read_csv('nfl_data.csv')

# split main dataframe into useful parts
game_data = data[['game_id', 'vis_team', 'home_team', 'vis_score', 'home_score', 'OT', 'game_date']].copy()
weather_data = data[['game_id', 'Temperature', 'Humidity', 'Wind_Speed', 'Roof', 'Surface']].copy()
player_data = data[['game_id', 'player_id', 'player', 'pos', 'team']].copy()

# remove unnecessary dataframe rows
game_data_unique = game_data.drop_duplicates('game_id')
weather_data_unique = weather_data.drop_duplicates('game_id')

# remove old data files so new ones can be created
if (os.path.exists('game_data.csv')) :
    os.remove('game_data.csv')

if (os.path.exists('weather_data.csv')) :
    os.remove('weather_data.csv')

# take dataframes and export to csv files
game_data_unique.to_csv('game_data.csv', index=False)
weather_data_unique.to_csv('weather_data.csv', index=False)