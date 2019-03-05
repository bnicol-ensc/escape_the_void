create database if not exists mymovies character set utf8 collate utf8_unicode_ci;
use escape_the_void;

grant all privileges on mymovies.* to 'escape_the_void_user'@'localhost' identified by 'secret';
