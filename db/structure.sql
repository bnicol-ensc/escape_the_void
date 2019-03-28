drop table if exists user_equipe;
drop table if exists user_mj;
drop table if exists escapeGame;
drop table if exists enigme;


create table escapeGame (
    eg_id integer not null primary key auto_increment,
    eg_nom varchar(50) not null,
    eg_description_short varchar(500) not null,
    eg_description_long varchar(2000) not null,
    eg_temps_max integer not null,
    eg_image varchar(150)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table user_equipe (
    usr_id integer not null primary key auto_increment,
    usr_nom varchar(50) not null,
    usr_login varchar(50) not null,
    usr_password varchar(255) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table user_mj (
    usr_id integer not null primary key auto_increment,
    usr_login varchar(50) not null,
    usr_password varchar(255) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table enigme (
    eng_id integer not null primary key auto_increment,
    eg_id integer not null,
    eng_type varchar(255) not null,
    eng_content varchar(2000) not null,
    eng_btn integer not null,
    eng_btn_active boolean,
    eng_btn_hidden boolean,
    eng_btn_name boolean,
    FOREIGN KEY (eg_id) REFERENCES escapeGame(eg_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;