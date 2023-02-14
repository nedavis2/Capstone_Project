class Player:

    def get_offence_score(self):

        '''
        #Basic scores
        offensive player:  (py + ry + ptd + rtd + int + pcon + rcon + cy + recy + rectd  + reccon + fum) = points scored
        pass_yards * .04 = py
        rush_yards * .1 = ry
        pass_TDs * 4 = ptd
        rush_TDs * 6 = rtd
        int * -2 = int
        pass_2pt * 2 = pcon
        rush_2pt * 2 = rcon
        catches * 1 = cy
        rec_yards * .1 = recy
        rec_TDs * 6 = rectd
        rec_2pt * 2 = reccon
        rush_2pt * 2 = rcon
        fumble * -2 = fum 
        '''
        pass

    def get_pos_rank(self):
        pass

    def get_injury_history(self):
        pass

class Team:
    def get_injury_stats_by_year(self, year : int):
        pass
    def get_team_defense(self):
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
