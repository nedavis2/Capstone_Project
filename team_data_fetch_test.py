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
    return ('targets_weekly' + str(player_targets_weekly(player_id)) 
            + 'rec_weekly' + str(player_rec_weekly(player_id)) 
            + 'rec_td_weekly' + str(player_rec_td_weekly(player_id)) 
            + 'rec_yds_weekly' + str(player_rec_yds_weekly(player_id)))
    
def player_receiver_view_month(player_id: str):
    return('targets_monthly' + str(player_targets_monthly(player_id)) 
           + 'rec_monthly' + str(player_rec_monthly(player_id)) 
           + 'rec_td_monthly' + str(player_rec_td_monthly(player_id)) 
           + 'rec_yds_monthly' + str(player_rec_yds_monthly(player_id)))
   
def player_receiver_view_total(player_id: str):
    return('targets_total #' + str(player_targets_total(player_id)) 
           + 'player_wide_receiver_rec_total' + str(player_rec_total(player_id)) 
           + 'player_wide_receiver_rec_td_total' + str(player_rec_td_total(player_id)) 
           + 'player_wide_receiver_rec_yds_total' + str(player_rec_yds_total(player_id)))
    
def player_rusher_view(player_id: str):
    return('rush_td_weekly' + str(player_rush_td_weekly(player_id)) 
           + 'rush_att_weekly' + str(player_rush_att_weekly(player_id)) 
           + 'rush_yds_weekly' + str(player_rush_yds_weekly(player_id)))

    
def player_rusher_view_month(player_id: str): 
    return(('rush_td_monthly') + str(player_rush_td_monthly(player_id)) 
           + 'rush_att_monthly' + str(player_rush_att_monthly(player_id)) 
           + 'rush_yds_monthly' + str(player_rush_yds_monthly(player_id)))
    
def player_rusher_view_total(player_id: str):   
    return('rush_td_total' + str(player_rush_td_total(player_id)) 
           + 'rush_att_total' + str(player_rush_att_total(player_id)) 
           + 'rush_yds_total' + str(player_rush_yds_total(player_id)))






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
        
            

          
#print(player_primary_view('RodgAa00','QB'))
#print(player_primary_view('AdamDa01','WR'))
#print(player_primary_view('TonyRo00','TE'))
#print(player_primary_view('JoneAa00','RB'))
#print(get_player_dates('RodgAa00'))
#print(get_team_dates(team))



def team_qb_view(team: str):
    return ('pass_att' + str(team_pass_att_weekly(team))
            + 'pass_cmp' + str(team_pass_cmp_weekly(team))
            + 'pass_td' + str(team_pass_td_weekly(team))
            + 'pass_yds' + str(team_pass_yds_weekly(team)))
    
def team_qb_view_month(team: str):
    return ('pass_att' + str(team_pass_att_monthly(team))
            + 'pass_cmp' + str(team_pass_cmp_monthly(team))
            + 'pass_td' + str(team_pass_td_monthly(team))
            + 'pass_yds' + str(team_pass_yds_monthly(team)))
    
def team_qb_view_total(team: str):
    return ('pass_att' + str(team_pass_att_total(team))
            + 'pass_cmp' + str(team_pass_cmp_total(team))
            + 'pass_td' + str(team_pass_td_total(team))
            + 'pass_yds' + str(team_pass_yds_total(team)))
    
def team_rushing_view(team: str):
    return ('rush_td_weekly' + str(team_rush_td_weekly(team)) 
            + 'rush_yds_weekly' + str(team_rush_yds_weekly(team)) 
            + 'rec_td_weekly' + str(team_rec_td_weekly(team)) 
            + 'rec_weekly' + str(team_rec_weekly(team)))
    
def team_rushing_view_month(team: str):
    return ('rush_td_monthly' + str(team_rush_td_monthly(team)) 
            +'rush_att_monthly' + str(team_rush_att_monthly(team)) 
            + 'rush_yds_monthly' + str(team_rush_yds_monthly(team)) 
            +'rec_td_monthly' + str(team_rec_td_monthly(team)) 
            + 'rec_monthly' + str(team_rec_monthly(team)))
    
def team_rushing_view_total(team: str):
    return ('rush_td_total' + str(team_rush_td_total(team)) 
            +'rush_att_total' + str(team_rush_att_total(team)) 
            + 'rush_yds_total' + str(team_rush_yds_total(team))) 
    
def team_receiever_view(team: str):
    return ('targets_weekly' + str(team_targets_weekly(team))
            + 'rec_weekly' + str(team_rec_weekly(team))
            + 'rec_td_weekly' + str(team_rec_td_weekly(team))
            + 'rec_yds_weekly' + str(team_rec_yds_weekly(team)))
    
def team_receiever_view_month(team: str):
    return ('targets_monthly' + str(team_targets_monthly(team))
            + 'rec_monthly' + str(team_rec_monthly(team)) 
            + 'rec_td_monthly' + str(team_rec_td_monthly(team)) 
            + 'rec_yds_monthly' + str(team_rec_yds_monthly(team)))
    
def team_receiever_view_total(team: str):
    return ('targets_total' + str(team_targets_total(team))
            + 'rec_total' + str(team_rec_total(team)) 
            + 'rec_td_total' + str(team_rec_td_total(team)) 
            + 'rec_yds_total' + str(team_rec_yds_total(team)))
    
def team_primary_view(team: str):
    return ('qb view' + str(team_qb_view(team)) + 'qb view month' 
            + str(team_qb_view_month(team)) + 'qb view total' + str(team_qb_view_total(team))
            + 'rb view' + str(team_rushing_view(team)) + 'rb view month' + str(team_rushing_view_month(team)) 
            + 'rb view total' + str(team_rushing_view_total(team)) + 'receiver view' + str(team_receiever_view(team)) 
            + 'receiever view month' + str(team_receiever_view_month(team)) + 'receiver view total' 
            + str(team_receiever_view_total(team)))
    
print(team_primary_view('GNB'))