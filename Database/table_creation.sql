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
    foreign key (player_id) references player(player_id)
);
CREATE TABLE game_stats_player (
    player_id       varchar(20)     not null,
    --stats 'n' stuff
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