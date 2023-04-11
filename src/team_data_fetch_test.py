from team_data_fetch import *



def player_qb_view(player_id: str):
    return (str(player_quarterback_pass_att_weekly(player_id)) + '#' 
            + str(player_quarterback_pass_cmp_weekly(player_id)) + '#' 
            + str(player_quarterback_pass_yds_weekly(player_id)) + '#'  
            + str(player_quarterback_pass_td_weekly(player_id)))
    
    
def player_qb_view_month(player_id: str):
    return (str(player_quarterback_pass_att_monthly(player_id)) + '#' 
            + str(player_quarterback_pass_cmp_monthly(player_id)) + '#' 
            + str(player_quarterback_pass_yds_monthly(player_id)) + '#' 
            + str(player_quarterback_pass_td_monthly(player_id)))
    
    
def player_qb_view_total(player_id: str):
    return (str(player_quarterback_pass_att_total(player_id)) + '#' 
            + str(player_quarterback_pass_cmp_total(player_id)) + '#' 
            + str(player_quarterback_pass_yds_total(player_id)) + '#' 
            + str(player_quarterback_pass_td_total(player_id)))
    

def player_receiver_view(player_id: str):
    return (str(player_targets_weekly(player_id)) + "#"
            + str(player_rec_weekly(player_id)) + "#"
            + str(player_rec_td_weekly(player_id)) + "#"
            + str(player_rec_yds_weekly(player_id)))
    
def player_receiver_view_month(player_id: str):
    return(str(player_targets_monthly(player_id)) + "#"
           + str(player_rec_monthly(player_id)) + "#"
           + str(player_rec_td_monthly(player_id)) + "#"
           + str(player_rec_yds_monthly(player_id)))
   
def player_receiver_view_total(player_id: str):
    return(str(player_targets_total(player_id)) + "#"
           + str(player_rec_total(player_id)) + "#"
           + str(player_rec_td_total(player_id)) + "#"
           + str(player_rec_yds_total(player_id)))
    
def player_avg_rec_view(player_id: str):
    return(str(player_avg_rec_yds(player_id)) + "#"
           + str(player_avg_rec_td(player_id)) + "#"
           + str(player_avg_targets(player_id)))
    
def player_rusher_view(player_id: str):
    return(str(player_rush_td_weekly(player_id)) + "#"
           + str(player_rush_att_weekly(player_id)) + "#"
           + str(player_rush_yds_weekly(player_id)))

    
def player_rusher_view_month(player_id: str): 
    return(str(player_rush_td_monthly(player_id)) + "#" 
           + str(player_rush_att_monthly(player_id)) + "#" 
           + str(player_rush_yds_monthly(player_id)))
    
def player_rusher_view_total(player_id: str):   
    return(str(player_rush_td_total(player_id)) + "#" 
           + str(player_rush_att_total(player_id)) + "#" 
           + str(player_rush_yds_total(player_id)))






def player_primary_view(player_id: str, pos: str):
    if (pos == 'QB'):
            return (player_qb_view(player_id) + "#" + player_qb_view_month(player_id) + "#" 
                    + player_qb_view_total(player_id) + "#" + player_rusher_view( player_id) + "#" 
                    + player_rusher_view_month( player_id) + "#" + player_rusher_view_total( player_id) + "#"
                    + str(get_player_dates(player_id)) + "#" + str(get_player_dates(player_id, False)))
    elif(pos == 'RB'):
            return (player_rusher_view( player_id) + "#" + player_rusher_view_month( player_id) + "#" 
                    + player_rusher_view_total( player_id) + "#" + player_receiver_view(player_id) + "#" 
                    + player_receiver_view_month(player_id) + "#" + player_receiver_view_total(player_id) + "#"
                    + str(get_player_dates(player_id))  + "#" + str(get_player_dates(player_id, False)))
    else:
            return (player_receiver_view(player_id) + "#" + player_receiver_view_month(player_id) + "#" 
                    + player_receiver_view_total(player_id) + "#" + str(get_player_dates(player_id))
                     + "#" + str(get_player_dates(player_id, False)))
        
            

          

#print(player_primary_view('RodgAa00','QB'))
#print(player_primary_view('FullAa01','WR'))
#print(player_primary_view('TonyRo00','TE'))
#print(player_primary_view('JoneAa00','RB'))
#print(get_player_dates('RodgAa00'))
#print(get_team_dates(team))

#print(player_receiver_view('JoneAa00'))
#player_receiver_view_month('JoneAa00')
#player_receiver_view_total('JoneAa00')

#print(player_targets_weekly('JoneAa00'))
#print(player_rec_weekly('JoneAa00'))
#print(player_rec_td_weekly('JoneAa00'))
#print(player_rec_yds_weekly('JoneAa00'))

#print(player_avg_rec_view('JoneAa00'))



def team_qb_view(team: str):
    return (str(team_pass_att_weekly(team)) + '#' 
            + str(team_pass_cmp_weekly(team)) + '#' 
            + str(team_pass_td_weekly(team)) + '#' 
            + str(team_pass_yds_weekly(team)))
    
def team_qb_view_month(team: str):
    return (str(team_pass_att_monthly(team)) + '#' 
            + str(team_pass_cmp_monthly(team)) + '#' 
            + str(team_pass_td_monthly(team)) + '#' 
            + str(team_pass_yds_monthly(team)))
    
def team_qb_view_total(team: str):
    return ( str(team_pass_att_total(team)) + '#' 
            + str(team_pass_cmp_total(team)) + '#' 
            + str(team_pass_td_total(team)) + '#' 
            + str(team_pass_yds_total(team)))
    
def team_rushing_view(team: str):
    return (str(team_rush_td_weekly(team)) + '#' 
            + str(team_rush_att_weekly(team)) + '#' 
            + str(team_rush_yds_weekly(team)))
    
def team_rushing_view_month(team: str):
    return (str(team_rush_td_monthly(team)) + '#' 
            + str(team_rush_att_monthly(team)) + '#' 
            + str(team_rush_yds_monthly(team))) 
    
def team_rushing_view_total(team: str):
    return (str(team_rush_td_total(team)) + '#' 
            + str(team_rush_att_total(team)) + '#' 
            + str(team_rush_yds_total(team))) 
    
def team_receiever_view(team: str):
    return (str(team_targets_weekly(team)) + '#' 
            + str(team_rec_weekly(team)) + '#' 
            + str(team_rec_td_weekly(team)) + '#' 
            + str(team_rec_yds_weekly(team)))
    
def team_receiever_view_month(team: str):
    return (str(team_targets_monthly(team)) + '#' 
            + str(team_rec_monthly(team)) + '#' 
            + str(team_rec_td_monthly(team)) + '#' 
            + str(team_rec_yds_monthly(team)))
    
def team_receiever_view_total(team: str):
    return (str(team_targets_total(team)) + '#' 
            + str(team_rec_total(team)) + '#' 
            + str(team_rec_td_total(team)) + '#' 
            + str(team_rec_yds_total(team)))
    
    
def team_primary_view(team: str):
    return (team_qb_view(team) + '#' + team_qb_view_month(team) + '#' + team_qb_view_total(team) + '#' 
            + team_rushing_view(team) + '#' + team_rushing_view_month(team) + '#' 
            + team_rushing_view_total(team) + '#' + team_receiever_view(team) + '#' 
            + team_receiever_view_month(team) + '#' + team_receiever_view_total(team) + "#"
            + str(get_team_dates(team, True)) + "#" + str(get_team_dates(team, False)))

#print(get_team_dates('GNB'))