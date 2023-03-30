from team_data_fetch import *


#'RodgAa00','QB'  
#'AdamDa01','WR'
#'TonyRo00','TE'
#'JoneAa00','RB'


def player_qb_view(player_id: str):
    return ('pass_att_weekly' + str(player_quarterback_pass_att_weekly(player_id))
            + 'pass_cmp_weekly' + str(player_quarterback_pass_cmp_weekly(player_id))
            + 'pass_yds_weekly' + str(player_quarterback_pass_yds_weekly(player_id)) 
            + 'pass_td_weekly' + str(player_quarterback_pass_td_weekly(player_id)))
    
    
def player_qb_view_month(player_id: str):
    return ('pass_att_monthly' + str(player_quarterback_pass_att_monthly(player_id)) 
            + 'pass_cmp_monthly' + str(player_quarterback_pass_cmp_monthly(player_id)) 
            + 'pass_yds_monthly' + str(player_quarterback_pass_yds_monthly(player_id))
            + 'pass_td_monthly' + str(player_quarterback_pass_td_monthly(player_id)))
    
    
def player_qb_view_total(player_id: str):
    return ( 'pass_att_total' + str(player_quarterback_pass_att_total(player_id))
            + 'pass_cmp_total' + str(player_quarterback_pass_cmp_total(player_id))
            + 'pass_yds_total' + str(player_quarterback_pass_yds_total(player_id)) 
            + 'pass_td_total' + str(player_quarterback_pass_td_total(player_id)))
    

def player_receiver_view(player_id: str):
    return ('targets_weekly' + str(player_wide_receiver_targets_weekly(player_id)) 
            + 'rec_weekly' + str(player_wide_receiver_rec_weekly(player_id)) 
            + 'rec_td_weekly' + str(player_wide_receiver_rec_td_weekly(player_id)) 
            + 'rec_yds_weekly' + str(player_wide_receiver_rec_yds_weekly(player_id)))
    
def player_receiver_view_month(player_id: str):
    return('targets_monthly' + str(player_wide_receiver_targets_monthly(player_id)) 
           + 'rec_monthly' + str(player_wide_receiver_rec_monthly(player_id)) 
           + 'rec_td_monthly' + str(player_wide_receiver_rec_td_monthly(player_id)) 
           + 'rec_yds_monthly' + str(player_wide_receiver_rec_yds_monthly(player_id)))
   
def player_receiver_view_total(player_id: str):
    return('targets_total #' + str(player_wide_receiver_targets_total(player_id)) 
           + 'player_wide_receiver_rec_total' + str(player_wide_receiver_rec_total(player_id)) 
           + 'player_wide_receiver_rec_td_total' + str(player_wide_receiver_rec_td_total(player_id)) 
           + 'player_wide_receiver_rec_yds_total' + str(player_wide_receiver_rec_yds_total(player_id)))
    
def player_rusher_view(player_id: str):
    return('rush_td_weekly' + str(player_running_back_rush_td_weekly(player_id)) 
           + 'rush_att_weekly' + str(player_running_back_rush_att_weekly(player_id)) 
           + 'rush_yds_weekly' + str(player_running_back_rush_yds_weekly(player_id)))

    
def player_rusher_view_month(player_id: str): 
    return(('rush_td_monthly') + str(player_running_back_rush_td_monthly(player_id)) 
           + 'rush_att_monthly' + str(player_running_back_rush_att_monthly(player_id)) 
           + 'rush_yds_monthly' + str(player_running_back_rush_yds_monthly(player_id)))
    
def player_rusher_view_total(player_id: str):   
    return('rush_td_total' + str(player_running_back_rush_td_total(player_id)) 
           + 'rush_att_total' + str(player_running_back_rush_att_total(player_id)) 
           + 'rush_yds_total' + str(player_running_back_rush_yds_total(player_id)))






def player_primary_view(player_id: str, pos: str):
    match pos:
        case 'QB':
            return (player_qb_view(player_id) + "#" + player_qb_view_month(player_id) + "#" 
                    + player_qb_view_total(player_id) + "#" + player_rusher_view( player_id) + "#" 
                    + player_rusher_view_month( player_id) + "#" + player_rusher_view_total( player_id) + "#" 
                    + player_receiver_view(player_id) + "#" + player_receiver_view_month(player_id) + "#" 
                    + player_receiver_view_total(player_id))
        case 'RB':
            return (player_rusher_view( player_id) + "#" + player_rusher_view_month( player_id) + "#" 
                    + player_rusher_view_total( player_id) + "#" + player_receiver_view(player_id) + "#" 
                    + player_receiver_view_month(player_id) + "#" + player_receiver_view_total(player_id))
        case _:
            return (player_receiver_view(player_id) + "#" + player_receiver_view_month(player_id) + "#" 
                    + player_receiver_view_total(player_id))
        
            

          
print(player_primary_view('RodgAa00','QB'))
#print(player_primary_view('AdamDa01','WR'))
#rint(player_primary_view('TonyRo00','TE'))
#print(player_primary_view('JoneAa00','RB'))



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