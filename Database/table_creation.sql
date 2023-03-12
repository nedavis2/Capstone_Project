CREATE TABLE player (
    player_id       varchar(20)     not null,
    pFName          varchar(20)     not null,
    pLName          varchar(20)     not null,
    pPOS            varchar(20)     not null,
    tAbbrev         varchar(20)     not null,
    tLocation       varchar(20)     not null,
    tNick           varchar(20)     not null,
    primary key (player_id, pFName, pLName)
);
CREATE TABLE game (
    game_id         varchar(20)     not null,
    teamAway        varchar(20)     not null,
    teamHome        varchar(20)     not null,
    scoreAway       numeric(3,0)    not null,
    scoreHome       numeric(3,0)    not null,
    game_date       DATE            not null,
    OT_yn           varchar(20),
    primary key (game_id, game_date)
);
CREATE TABLE weather (
    game_id         varchar(20)     not null,
    temperature     numeric(3,1),
    humididty       numeric(3,0),
    wind_speed      numeric(2,0),
    roof            varchar(20),
    surface         varchar(20),
    foreign key (game_id) references game(game_id)
);
CREATE TABLE user (
    user_id         varchar(20)     not null,
    saved_player    varchar(20),
    primary key (user_id),
    foreign key (saved_player) references player(player_id)
);
CREATE TABLE game_stats_team (
    game_id         varchar(20)     not null,
    --stats 'n' stuff 
    Vis_team        VARCHAR(20),
    Opponent_abbrev VARCHAR(5),
    Home_team       VARCHAR(20),
    Team_abbrev     VARCHAR(5),
    Vis_score       INT(10),
    Home_score      INT(10),
    Pass_sacked     int(10),   
    Pass_sacked_yds int(10),
    Rush_scrambles  INT(10),
    Designed_rush_att   INT(10),
    Comb_pass_rush_play INT(10),
    Comb_pass_play      INT(10),
    Comb_rush_play      INT(10),
    Total_ret_td        INT(10),
    Offensive_fumble_recovery_td    INT(10),
    Pass_blitzed        INT(10),
    Pass_hurried        INT(10),

    foreign key (player_id) references player(player_id)
);
CREATE TABLE game_stats_player (
    player_id       varchar(20)     not null,
    --stats 'n' stuff
    Pass_cmp        int(10),
    Pass_att        int(10),
    Pass_yds        int(10),
    Pass_td         int(10),
    Pass_int        int(10),
    Pass_long       int(10),
    Pass_rating     int(10),
    Rush_att        INT(10),
    Rush_yds        INT(10),
    Rush_td         INT(10),
    Rush_long       INT(10),
    Targets         INT(10),
    Rec             INT(10),
    Rec_yds         INT(10),
    Rec_td          INT(10),
    Rec_long        INT(10),
    Fumbles_lost    INT(10),
    Two_point_conv      INT(10),
    Pass_target_yds     INT(10),
    Pass_poor_throws    INT(10),
    Rush_yds_before_contact     INT(10),
    Rush_yac            INT(10),
    Rush_broken_tackles INT(10),
    Rec_air_yds         DECIMAL(2.2),
    Rec_yac         INT(10),
    Rec_drops       INT(10),
    foreign key (player_id) references player(player_id)
);
CREATE TABLE injury (
    player_id       varchar(20)     not null,
    startDate       DATE,
    endDate         DATE,
    type            varchar(20),
    severity        numeric(2,0),
    foreign key (player_id) references player(player_id)
);