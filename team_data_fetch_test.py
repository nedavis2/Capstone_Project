from team_data_fetch import *


#Player QB stuff
#TODO


#Player WR stuff
def player_wr_fetch(player_id: str):
    print('player_wide_receiver_targets_weekly')
    print(player_wide_receiver_targets_weekly(player_id))
    print('player_wide_receiver_targets_total')
    print(player_wide_receiver_targets_total(player_id))
    print('player_wide_receiver_rec_total')
    print(player_wide_receiver_rec_total(player_id))
    print('player_wide_receiver_rec_td_total')
    print(player_wide_receiver_rec_td_total(player_id))
    print('player_wide_receiver_rec_yds_total')
    print(player_wide_receiver_rec_yds_total(player_id))
    print('player_wide_receiver_rec_weekly')
    print(player_wide_receiver_rec_weekly(player_id))
    print('player_wide_receiver_rec_td_weekly')
    print(player_wide_receiver_rec_td_weekly(player_id))
    print('player_wide_receiver_rec_yds_weekly')
    print(player_wide_receiver_rec_yds_weekly(player_id))
    print('player_wide_receiver_targets_monthly')
    print(player_wide_receiver_targets_monthly(player_id))
    print('player_wide_receiver_rec_monthly')
    print(player_wide_receiver_rec_monthly(player_id))
    print('player_wide_receiver_rec_td_monthly')
    print(player_wide_receiver_rec_td_monthly(player_id))
    print('player_wide_receiver_rec_yds_monthly')
    print(player_wide_receiver_rec_yds_monthly(player_id))
    
    
#player rb stuff

# #Player RB stuff
def player_rb_fetch(player_id: str):
    print('player_running_back_rush_td_total')
    print(player_running_back_rush_td_total(player_id))
    print('player_running_back_rush_att_total')
    print(player_running_back_rush_att_total(player_id))
    print('player_running_back_rush_yds_total')
    print(player_running_back_rush_yds_total(player_id))
    print('player_running_back_rec_td_total')
    print(player_running_back_rec_td_total(player_id))
    print('player_running_back_rec_total')
    print(player_running_back_rec_total(player_id))
    print('player_running_back_rush_td_weekly')
    print(player_running_back_rush_td_weekly(player_id))
    print('player_running_back_rush_att_weekly')
    print(player_running_back_rush_att_weekly(player_id))
    print('player_running_back_rush_yds_weekly')
    print(player_running_back_rush_yds_weekly(player_id))
    print('player_running_back_rec_td_weekly')
    print(player_running_back_rec_td_weekly(player_id))
    print('player_running_back_rec_weekly')
    print(player_running_back_rec_weekly(player_id))
    print('player_running_back_rush_td_monthly')
    print(player_running_back_rush_td_monthly(player_id))
    print('player_running_back_rush_att_monthly')
    print(player_running_back_rush_att_monthly(player_id))
    print('player_running_back_rush_yds_monthly')
    print(player_running_back_rush_yds_monthly(player_id))
    print('player_running_back_rec_td_monthly')
    print(player_running_back_rec_td_monthly(player_id))
    print('player_running_back_rec_monthly')
    print(player_running_back_rec_monthly(player_id))
    
#'AdamDa01'
#'TonyRo00'



def player_receiver_view_1(player_id: str):
    print('player_wide_receiver_targets_weekly #')
    print(player_wide_receiver_targets_weekly(player_id))
    print('player_wide_receiver_rec_weekly')
    print(player_wide_receiver_rec_weekly(player_id))
    print('player_wide_receiver_rec_td_weekly')
    print(player_wide_receiver_rec_td_weekly(player_id))
    print('player_wide_receiver_rec_yds_weekly')
    print(player_wide_receiver_rec_yds_weekly(player_id))
    
def player_receiver_view_1_month(player_id: str):
    print('player_wide_receiver_targets_monthly #')
    print(player_wide_receiver_targets_monthly(player_id))
    print('player_wide_receiver_rec_monthly')
    print(player_wide_receiver_rec_monthly(player_id))
    print('player_wide_receiver_rec_td_monthly')
    print(player_wide_receiver_rec_td_monthly(player_id))
    print('player_wide_receiver_rec_yds_monthly')
    print(player_wide_receiver_rec_yds_monthly(player_id))
   
def player_receiver_view_1_total(player_id: str):
    print('player_wide_receiver_targets_total #')
    print(player_wide_receiver_targets_total(player_id))
    print('player_wide_receiver_rec_total')
    print(player_wide_receiver_rec_total(player_id))
    print('player_wide_receiver_rec_td_total')
    print(player_wide_receiver_rec_td_total(player_id))
    print('player_wide_receiver_rec_yds_total')
    print(player_wide_receiver_rec_yds_total(player_id))
    
def player_rusher_view_1(player_id: str):
    print('player_running_back_rush_td_weekly')
    print(player_running_back_rush_td_weekly(player_id))
    print('player_running_back_rush_att_weekly')
    print(player_running_back_rush_att_weekly(player_id))
    print('player_running_back_rush_yds_weekly')
    print(player_running_back_rush_yds_weekly(player_id))

    
def player_rusher_view_1_month(player_id: str): 
    print('player_running_back_rush_td_monthly')
    print(player_running_back_rush_td_monthly(player_id))
    print('player_running_back_rush_att_monthly')
    print(player_running_back_rush_att_monthly(player_id))
    print('player_running_back_rush_yds_monthly')
    print(player_running_back_rush_yds_monthly(player_id))
    
def player_rusher_view_1_total(player_id: str):   
    print('player_running_back_rush_td_total')
    print(player_running_back_rush_td_total(player_id))
    print('player_running_back_rush_att_total')
    print(player_running_back_rush_att_total(player_id))
    print('player_running_back_rush_yds_total')
    print(player_running_back_rush_yds_total(player_id))






def player_primary_view(player_id: str, pos: str):
    match pos:
        case 'RB':
            view = player_rusher_view_1( player_id) + "#" + player_rusher_view_1_month( player_id) + "#" 
            + player_rusher_view_1_total( player_id) + "#" + player_receiver_view_1(player_id) + "#" 
            + player_receiver_view_1_month(player_id) + "#" + player_receiver_view_1_total(player_id)
        case 'WR':
            view = str(player_receiver_view_1(player_id) + "#" + player_receiver_view_1_month(player_id) + "#"
            + player_receiver_view_1_total(player_id))
            
            
player_primary_view('AdamDa01','WR')



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