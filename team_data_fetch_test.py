from team_data_fetch import *


#Player QB stuff
#TODO


    
    
#player rb stuff


    
#'AdamDa01'
#'TonyRo00'



def player_receiver_view_1(player_id: str):
    return ('player_wide_receiver_targets_weekly #' + str(player_wide_receiver_targets_weekly(player_id))
    + 'player_wide_receiver_rec_weekly' + str(player_wide_receiver_rec_weekly(player_id))
    + 'player_wide_receiver_rec_td_weekly' + str(player_wide_receiver_rec_td_weekly(player_id))
    + 'player_wide_receiver_rec_yds_weekly' + str(player_wide_receiver_rec_yds_weekly(player_id)))
    
def player_receiver_view_1_month(player_id: str):
    return(('player_wide_receiver_targets_monthly #')
    +str(player_wide_receiver_targets_monthly(player_id))
    +str('player_wide_receiver_rec_monthly')
    +str(player_wide_receiver_rec_monthly(player_id))
    +str('player_wide_receiver_rec_td_monthly')
    +str(player_wide_receiver_rec_td_monthly(player_id))
    +str('player_wide_receiver_rec_yds_monthly')
    +str(player_wide_receiver_rec_yds_monthly(player_id)))
   
def player_receiver_view_1_total(player_id: str):
    return(('player_wide_receiver_targets_total #')
    +str(player_wide_receiver_targets_total(player_id))
    +str('player_wide_receiver_rec_total')
    +str(player_wide_receiver_rec_total(player_id))
    +str('player_wide_receiver_rec_td_total')
    +str(player_wide_receiver_rec_td_total(player_id))
    +str('player_wide_receiver_rec_yds_total')
    +str(player_wide_receiver_rec_yds_total(player_id)))
    
def player_rusher_view_1(player_id: str):
    return(('player_running_back_rush_td_weekly')
    +str(player_running_back_rush_td_weekly(player_id))
    +str('player_running_back_rush_att_weekly')
    +str(player_running_back_rush_att_weekly(player_id))
    +str('player_running_back_rush_yds_weekly')
    +str(player_running_back_rush_yds_weekly(player_id)))

    
def player_rusher_view_1_month(player_id: str): 
    return(('player_running_back_rush_td_monthly')
    +str(player_running_back_rush_td_monthly(player_id))
    +str('player_running_back_rush_att_monthly')
    +str(player_running_back_rush_att_monthly(player_id))
    +str('player_running_back_rush_yds_monthly')
    +str(player_running_back_rush_yds_monthly(player_id)))
    
def player_rusher_view_1_total(player_id: str):   
    return(('player_running_back_rush_td_total')
    +str(player_running_back_rush_td_total(player_id))
    +str('player_running_back_rush_att_total')
    +str(player_running_back_rush_att_total(player_id))
    +str('player_running_back_rush_yds_total')
    +str(player_running_back_rush_yds_total(player_id)))






def player_primary_view(player_id: str, pos: str):
    view = None
    match pos:
        case 'RB':
            view = player_rusher_view_1( player_id) + "#" + player_rusher_view_1_month( player_id) + "#" 
            + player_rusher_view_1_total( player_id) + "#" + player_receiver_view_1(player_id) + "#" 
            + player_receiver_view_1_month(player_id) + "#" + player_receiver_view_1_total(player_id)
        case 'WR':
            view = str(player_receiver_view_1(player_id) + "#" + player_receiver_view_1_month(player_id) + "#"
            + player_receiver_view_1_total(player_id))
    return view
            
            
print(player_primary_view('AdamDa01','WR'))



#Team WR/TE stuff

def team_wr_fetch(team: str):
    print('team_wide_receiver_targets_weekly')
    print(team_wide_receiver_targets_weekly('GNB'))
    print('team_wide_receiver_rec_weekly')
    print(team_wide_receiver_rec_weekly('GNB'))
    print('team_wide_receiver_rec_td_weekly')
    print(team_wide_receiver_rec_td_weekly('GNB'))
    print('team_wide_receiver_rec_yds_weekly')
    print(team_wide_receiver_rec_yds_weekly('GNB'))
    print('team_tight_end_targets_weekly')
    print(team_tight_end_targets_weekly('GNB'))
    print('team_tight_end_rec_weekly')
    print(team_tight_end_rec_weekly('GNB'))
    print('team_tight_end_rec_td_weekly')
    print(team_tight_end_rec_td_weekly('GNB'))
    print('team_tight_end_rec_yds_weekly')
    print(team_tight_end_rec_yds_weekly('GNB'))
    print('team_wide_receiver_targets_monthly')
    print(team_wide_receiver_targets_monthly('GNB'))
    print('team_wide_receiver_rec_monthly')
    print(team_wide_receiver_rec_monthly('GNB'))
    print('team_wide_receiver_rec_td_monthly')
    print(team_wide_receiver_rec_td_monthly('GNB'))
    print('team_wide_receiver_rec_yds_monthly')
    print(team_wide_receiver_rec_yds_monthly('GNB'))
    print('team_tight_end_targets_monthly')
    print(team_tight_end_targets_monthly('GNB'))
    print('team_tight_end_rec_monthly')
    print(team_tight_end_rec_monthly('GNB'))
    print('team_tight_end_rec_td_monthly')
    print(team_tight_end_rec_td_monthly('GNB'))
    print('team_tight_end_rec_yds_monthly')
    print(team_tight_end_rec_yds_monthly('GNB'))

#Team RB stuff

def team_rb_fetch(team: str):
    print('team_running_back_rush_td_weekly')
    print(team_running_back_rush_td_weekly('GNB'))
    print('team_running_back_rush_yds_weekly')
    print(team_running_back_rush_yds_weekly('GNB'))
    print('team_running_back_rec_td_weekly')
    print(team_running_back_rec_td_weekly('GNB'))
    print('team_running_back_rec_weekly')
    print(team_running_back_rec_weekly('GNB'))
    print('team_running_back_rush_td_monthly')
    print(team_running_back_rush_td_monthly('GNB'))
    print('team_running_back_rush_att_monthly')
    print(team_running_back_rush_att_monthly('GNB'))
    print('team_running_back_rush_yds_monthly')
    print(team_running_back_rush_yds_monthly('GNB'))
    print('team_running_back_rec_td_monthly')
    print(team_running_back_rec_td_monthly('GNB'))
    print('team_running_back_rec_monthly')
    print(team_running_back_rec_monthly('GNB'))

#Team QB stuff