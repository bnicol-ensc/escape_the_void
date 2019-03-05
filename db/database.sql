create database if not exists escape_the_void character set utf8 collate utf8_unicode_ci;
use escape_the_void;

grant all privileges on escape_the_void.* to 'escape_the_void_user'@'localhost' identified by 'secret';
