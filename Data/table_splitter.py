# import neccesary modules
import pandas as pd
import os

# read in the main data source
data = pd.read_csv('Data\\nfl_pass_rush_receive_raw_data.csv')

# split main dataframe into useful parts
game_data = data[['game_id', 'vis_team', 'home_team', 'vis_score', 'home_score', 'OT', 'game_date']].copy()
weather_data = data[['game_id', 'Temperature', 'Humidity', 'Wind_Speed', 'Roof', 'Surface']].copy()
player_description = data[['game_id', 'player_id', 'player', 'pos', 'team']].copy()

# drop unneeded columns for team stats
team_data = data.drop(columns=['Temperature', 'Humidity', 'Wind_Speed', 'Roof', 'Surface'])
team_data1 = team_data.drop(columns=['Vegas_Line', 'Vegas_Favorite', 'Over_Under'])
team_data2 = team_data1.drop(columns=['player_id', 'pos', 'player'])
team_data3 = team_data2.drop(columns=['Team_abbrev', 'Opponent_abbrev', 'vis_team', 'home_team', 'vis_score', 'home_score', 'OT'])
team_data4 = team_data3.drop(columns=['Total_DKP', 'Off_DKP', 'Total_FDP', 'Off_FDP', 'Total_SDP', 'Off_SDP'])

# drop unneeded columns for player stats
player_data = data.drop(columns=['Temperature', 'Humidity', 'Wind_Speed', 'Roof', 'Surface'])
player_data1 = player_data.drop(columns=['Vegas_Line', 'Vegas_Favorite', 'Over_Under'])
player_data2 = player_data1.drop(columns=['team'])
player_data3 = player_data2.drop(columns=['Team_abbrev', 'Opponent_abbrev', 'vis_team', 'home_team', 'vis_score', 'home_score', 'OT'])
player_data4 = player_data3.drop(columns=['Total_DKP', 'Off_DKP', 'Total_FDP', 'Off_FDP', 'Total_SDP', 'Off_SDP'])

# sum data for teams and players
team_stats = team_data4.groupby(['game_date', 'game_id', 'team'], as_index=False).sum()
player_stats = player_data4.groupby(['game_date', 'game_id', 'player_id', 'player', 'pos'], as_index=False).sum()

# remove unnecessary dataframe rows
game_data_unique = game_data.drop_duplicates('game_id')
weather_data_unique = weather_data.drop_duplicates('game_id')
player_description_unique = player_description.drop_duplicates(['player'])

# remove old data files so new ones can be created
if (os.path.exists('Data\\game_data.csv')) :
    os.remove('Data\\game_data.csv')

if (os.path.exists('Data\\weather_data.csv')) :
    os.remove('Data\\weather_data.csv')

if (os.path.exists('Data\\player_data.csv')) :
    os.remove('Data\\player_data.csv')

if (os.path.exists('Data\\team_stats.csv')) :
    os.remove('Data\\team_stats.csv')

if (os.path.exists('Data\\player_stats.csv')) :
    os.remove('Data\\player_stats.csv')

# take dataframes and export to csv files
game_data_unique.to_csv('Data\\game_data.csv', index=False)
weather_data_unique.to_csv('Data\\weather_data.csv', index=False)
player_description_unique.to_csv('Data\\player_data.csv', index=False)
team_stats.to_csv('Data\\team_stats.csv', index=False)
player_stats.to_csv('Data\\player_stats.csv', index=False)

# testing print statements
#print(player_stats.loc[player_stats['pos'] == 'WR'])
print(player_stats)