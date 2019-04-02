drop table if exists escapeGameCours;
drop table if exists enigmeCours;
drop table if exists user_equipe;
drop table if exists user_mj;
drop table if exists bouton;

drop table if exists indice;
drop table if exists enigme;
drop table if exists escapegame;

create table escapeGame (
    eg_id integer not null primary key auto_increment,
    eg_nom varchar(50) not null,
    eg_description_short varchar(500) not null,
    eg_description_long varchar(2000) not null,
    eg_temps_max integer not null,
    eg_image varchar(150)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table user_equipe (
    usr_nom varchar(50) not null,
    usr_login varchar(50) not null primary key,
    usr_password varchar(255) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table user_mj (
    usr_id integer not null primary key auto_increment,
    usr_login varchar(50) not null,
    usr_password varchar(255) not null,
    UNIQUE(usr_login)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table enigme (
    eng_id integer not null primary key auto_increment,
    eg_id integer not null,
    eng_content varchar(2000),
    FOREIGN KEY (eg_id) REFERENCES escapeGame(eg_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table bouton (
    eng_id integer,
    btn integer not null,
    btn_type varchar(255) not null,
    btn_active boolean,
    btn_expected integer,
    btn_name varchar(255) not null,
    btn_content varchar(2000),
    PRIMARY KEY (eng_id, btn),
    FOREIGN KEY (eng_id) REFERENCES enigme(eng_id)
)engine=innodb character set utf8 collate utf8_unicode_ci;

create table enigmeCours (
    equipe varchar(50) not null,
    eng_id integer not null,
    temps integer null,
    finie boolean not null,
    PRIMARY KEY (equipe,eng_id),
    FOREIGN KEY (eng_id) REFERENCES enigme(eng_id),
    FOREIGN KEY (equipe) REFERENCES user_equipe(usr_login)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table escapeGameCours (
    egc_id integer not null primary key auto_increment,
    eg_id integer not null,
    eng_cours varchar(50) not null,
    FOREIGN KEY (eg_id) REFERENCES escapeGame(eg_id),
    FOREIGN KEY (eng_cours) REFERENCES enigmeCours(equipe)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table indice (
    indice_id integer not null primary key auto_increment,
    indice_text varchar(500) not null,
    eng_id integer not null,
    FOREIGN KEY (eng_id) REFERENCES enigme(eng_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table statistiqueEnigme (
    se_id integer not null primary key auto_increment,
    eng_id integer not null,
    temps integer not null,
    equipe varchar(50) not null,
    FOREIGN KEY (eng_id) REFERENCES enigme(eng_id),
    FOREIGN KEY (equipe) REFERENCES user_equipe(usr_login)
) engine=innodb character set utf8 collate utf8_unicode_ci;