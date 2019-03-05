drop table if exists user;
drop table if exists escapeGame;

create table escapeGame (
    eg_id integer not null primary key auto_increment,
    eg_nom varchar(50) not null,
    eg_description_short varchar(500) not null,
    eg_description_long varchar(2000) not null,
    eg_temps_max integer not null,
    eg_image varchar(150)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table user (
    usr_id integer not null primary key auto_increment,
    usr_login varchar(50) not null,
    usr_password varchar(88) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;