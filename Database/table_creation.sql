DROP TABLE IF EXISTS nfl_pass_rush_receive_raw_data;
DROP TABLE IF EXISTS predictions;
DROP TABLE IF EXISTS injury;
DROP TABLE IF EXISTS game_stats_player;
DROP TABLE IF EXISTS game_stats_team;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS weather;
DROP TABLE IF EXISTS game;
DROP TABLE IF EXISTS player;

CREATE TABLE player (
    game_id         varchar(20)     not null,
    player_id       varchar(20)     not null,
    pName           varchar(20)     not null,
    POS             varchar(20)     not null,
    team            varchar(20)     not null,
    primary key (player_id, pName)
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
    primary key (game_id),
    foreign key (game_id) references game(game_id)
);
CREATE TABLE user (
    user_email      varchar(30)     not null,
    QB              varchar(20),
    RB_1            varchar(20),
    RB_2            varchar(20),
    WR_1            varchar(20),
    WR_2            varchar(20),
    TE              varchar(20),
    Flex            varchar(20),
    team            varchar(20),
    primary key (user_email)
);
CREATE TABLE game_stats_team (
    game_date                       DATE            not null,
    game_id                         varchar(20)     not null,
    team                            varchar(5)      not null,
    pass_cmp                        INT(4),
    pass_att                        INT(4),
    pass_yds                        INT(4),
    pass_td                         INT(4),
    pass_int                        INT(4),
    pass_sacked                     INT(4),
    pass_sacked_yds                 INT(4),
    pass_long                       INT(4),
    pass_rating                     numeric(3,1),
    rush_att                        INT(4),
    rush_yds                        INT(4),
    rush_td                         INT(4),
    rush_long                       INT(4),
    targets                         INT(4),
    rec                             INT(4),
    rec_yds                         INT(4),
    rec_td                          INT(4),
    rec_long                        INT(4),
    fumbles_lost                    INT(4),
    rush_scrambles                  INT(4),
    designed_rush_att               INT(4),
    comb_pass_rush_play             INT(4),
    comb_pass_play                  INT(4),
    comb_rush_play                  INT(4),
    two_point_conv                  INT(4),
    total_ret_td                    INT(4),
    offensive_fumble_recovery_td    INT(4),
    pass_yds_bonus                  INT(4),
    rush_yds_bonus                  INT(4),
    rec_yds_bonus                   INT(4),
    pass_target_yds                 INT(4),
    pass_poor_throws                INT(4),
    pass_blitzed                    INT(4),
    pass_hurried                    INT(4),
    rush_yds_before_contact         INT(4),
    rush_yac                        INT(4),
    rush_broken_tackles             INT(4),
    rec_air_yds                     numeric(3,1),
    rec_yac                         INT(4),
    rec_drops                       INT(4),
    offense                         INT(4),
    off_pct                         INT(4),
    yds_per_rec                     numeric(3,2),
    yds_per_rush                    numeric(3,2),
    yds_per_target                  numeric(3,2),
    primary key (game_date, game_id, team),
    foreign key (game_id) references game(game_id)
);
CREATE TABLE game_stats_player (
    game_date                       DATE            not null,
    game_id                         varchar(20)     not null,
    player_id                       varchar(20)     not null,
    player                          varchar(30)     not null,
    pos                             varchar(5)      not null,
    pass_cmp                        INT(4),
    pass_att                        INT(4),
    pass_yds                        INT(4),
    pass_td                         INT(4),
    pass_int                        INT(4),
    pass_sacked                     INT(4),
    pass_sacked_yds                 INT(4),
    pass_long                       INT(4),
    pass_rating                     numeric(3,1),
    rush_att                        INT(4),
    rush_yds                        INT(4),
    rush_td                         INT(4),
    rush_long                       INT(4),
    targets                         INT(4),
    rec                             INT(4),
    rec_yds                         INT(4),
    rec_td                          INT(4),
    rec_long                        INT(4),
    fumbles_lost                    INT(4),
    rush_scrambles                  INT(4),
    designed_rush_att               INT(4),
    comb_pass_rush_play             INT(4),
    comb_pass_play                  INT(4),
    comb_rush_play                  INT(4),
    two_point_conv                  INT(4),
    total_ret_td                    INT(4),
    offensive_fumble_recovery_td    INT(4),
    pass_yds_bonus                  INT(4),
    rush_yds_bonus                  INT(4),
    rec_yds_bonus                   INT(4),
    pass_target_yds                 INT(4),
    pass_poor_throws                INT(4),
    pass_blitzed                    INT(4),
    pass_hurried                    INT(4),
    rush_yds_before_contact         INT(4),
    rush_yac                        INT(4),
    rush_broken_tackles             INT(4),
    rec_air_yds                     numeric(3,1),
    rec_yac                         INT(4),
    rec_drops                       INT(4),
    offense                         INT(4),
    off_pct                         INT(4),
    yds_per_rec                     numeric(3,2),
    yds_per_rush                    numeric(3,2),
    yds_per_target                  numeric(3,2),
    primary key (game_date, game_id, player_id, player, pos),
    foreign key (game_id) references game(game_id),
    foreign key (player_id) references player(player_id)
);
CREATE TABLE injury (
    player_name        varchar(20)      not null,
    position           varchar(20)      not null,
    injury_type        varchar(20),
    practice_status    varchar(20),
    game_status        varchar(20),
    primary key (player_name, position)
);
CREATE TABLE predictions (
    player_id        varchar(20)     not null,
    
    pass_att_total   int(3),
    pass_cmp_total   int(3),
    pass_yds_total   int(3),
    pass_td_total    int(3),
    rush_td_total    int(3),
    rush_att_total   int(3),
    rush_yds_total   int(3),
    targets_total    int(3),
    rec_total        int(3),
    rec_td_total     int(3),
    rec_yds_total    int(3),

    pass_att_weekly  int(3),
    pass_cmp_weekly  int(3),
    pass_yds_weekly  int(3),
    pass_td_weekly   int(3),
    rush_td_weekly   int(3),
    rush_att_weekly  int(3),
    rush_yds_weekly  int(3),
    targets_weekly   int(3),
    rec_weekly       int(3),
    rec_td_weekly    int(3),
    rec_yds_weekly   int(3),
    primary key (player_id)
);
