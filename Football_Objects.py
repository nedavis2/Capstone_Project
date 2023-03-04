import datetime
import pandas as pd
class Player:
    '''Representation of a given player'''
    
    def __init__(self, input_player_id : str, in_db):
        self.player_id = input_player_id
        
        #TODO: Query database with "SELECT * FROM `nfl_pass_rush_receive_raw_data` WHERE player_id = %s"%player_id
        
        #Then save that to db
        
        self.db = in_db.loc[(in_db["player_id"] == self.player_id), :]
        
        
    def get_offence_score(self, game) -> float:
        '''Returns the offence score of the player'''
        pass_yards = self.db[game]["pass_yds"]
        rush_yards = self.db[game]["rush_yds"]
        pass_TDs  = self.db[game]["pass_td"]
        rush_TDs  = self.db[game]["rush_td"]
        ints  = self.db[game]["pass_int"]
        two_pt_conv  = self.db[game]["two_point_conv"]
        catches  = self.db[game]["rec"]
        rec_yards  = self.db[game]["rec_yards"]
        rec_TDs  = self.db[game]["rec_td"]

        fumble  = self.db[game]["fumbles_lost"] #This one could be wrong
        
        
        #Basic scores
        #offensive player: 
        py = pass_yards * .04 
        ry = rush_yards * .1 
        ptd = pass_TDs * 4 
        rtd = rush_TDs * 6 
        ints =  ints * -2
        pcon = two_pt_conv * 2 
        cy = catches * 1 
        recy = rec_yards * .1 
        rectd = rec_TDs * 6 

        fum =  fumble * -2 
        points_scored = (py + ry + ptd + rtd + ints + pcon + cy + recy + rectd  + fum) 
        
        return points_scored

    def get_pos_rank(self) -> int:
        '''Returns the rank of the player relative to all other players'''
        
        
        pass

    def get_injury_history(self):
        '''Returns the injury history of this player'''
        pass

class Team:

    '''Representation of a team'''
    def __init__(self, team_id, db):
        '''Generate team object from given data'''
        self.tid = team_id
        self.team_db = db["team_id"] == team_id
        
        self.team_db = db.loc[self.team_db]
        
    def get_injury_stats_by_year(self, year : datetime):
        '''Returns the injury stats of a player in a year'''

        #TODO: Ask if a datetime object should be used rather than an int for year
        #NOTE: This should be a datetime.
        pass
    def get_team_defense(self) -> int:

        '''Returns the teams defensive score.'''
        '''
        team defense: (dint + fr + sk + sft + bk + points_allowed) = points scored

        block_kick * 2 = bk
        safety * 2 = sft
        sack * 1 = sk
        fum_recovery * 2 = fr
        int * 2 = dint

        '''
        '''

        #Note: I don't know what this one is
        #Total points against at the end of the game
        0 points_allowed = 10
        1 - 6 points_allowed = 8
        7 - 13 points_allowed = 6
        14 - 20 points_allowed = 2
        21 - 27 points_allowed = 1
        28 - 34 points_allowed = 0
        35 - 41 points_allowed = -2
        42+ points_allowed = -4
        '''
        pass
