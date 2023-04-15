generated_stat = input("enter needed stat")

def gen_functions(stat):
    '''Makes functions for the given stat'''



    out_total = '''def player_quarterback_%s_total(player_id : str) -> int:
    retreived_data = "%s"
    position = "QB"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)'''%(stat, stat)
    
    out_week = '''def player_quarterback_%s_weekly(player_id : str) -> tuple((list[int], list[date])):
  retreived_data = "%s"
  position = "QB"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)
  '''%(stat,stat)

    out_team = '''def team_quarterback_%s(team : str) -> tuple((list[int], list[date])):
    retreived_data = "%s"
    position = "QB"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True, position = position)'''%(stat, stat)


    print(out_total)

    print(out_week)

    print(out_team)

def gen_out_total(stat):
    print('''def player_quarterback_%s_total(player_id : str) -> int:
    retreived_data = "%s"
    position = "QB"
    return  _retrieve_player_total_data(player_id, retreived_data, table_name = used_table_name, position = position)'''%(stat, stat))

def gen_out_week(stat):
    print('''def player_quarterback_%s_weekly(player_id : str) -> tuple((list[int], list[date])):
  retreived_data = "%s"
  position = "QB"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = True, position = position)
  '''%(stat,stat))
    
def gen_out_month(stat):
  print('''def player_quarterback_%s_monthly(player_id : str) -> tuple((list[int], list[date])):
  retreived_data = "%s"
  position = "QB"
  return _retrieve_player_time_data(player_id, retreived_data, table_name = used_table_name, weekly = False, position = position)
  '''%(stat,stat))
def gen_out_team(stat):
    print('''def team_quarterback_%s(team : str) -> tuple((list[int], list[date])):
    retreived_data = "%s"
    position = "QB"
    return _retrieve_team_data(team,retreived_data = retreived_data, table_name = used_table_name, weekly = True, position = position)'''%(stat, stat))


player_stats = ["pass_att", "pass_cmp", "pass_yds", "pass_td"]

for i in player_stats:
  gen_out_week(i)
  gen_out_month(i)
  gen_out_total(i)
