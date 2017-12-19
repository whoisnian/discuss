<?php
$dbhost = 'localhost';
$dbuser = 'user';
$dbpass = 'password';

$con = mysql_connect($dbhost, $dbuser, $dbpass);
if(!$con) {
    die('Could not connect: '.mysql_error());
}

mysql_query($con, 'create database discuss');
mysql_select_db($con, 'discuss');

mysql_query($con, 'create table user(
                    userid int(11) not null auto_increment,
                    username varchar(30) not null unique,
                    password varchar(30) not null,
                    qq varchar(30) not null,
                    email varchar(30) not null unique,
                    blog varchar(30) not null,
                    gender int(11) not null,
                    logged varchar(200) not null,
                    primary key (userid))');

mysql_query($con, 'create table message(
                    messageid int(11) not null auto_increment,
                    username varchar(30) not null,
                    title varchar(50) not null,
                    message varchar(500) not null,
                    time datetime not null,
                    anonymous int(11) not null,
                    primary key (messageid))');

mysql_query($con, 'create table reply(
                    replyid int(11) not null auto_increment,
                    replyto int(11) not null,
                    username varchar(30) not null,
                    reply varchar(500) not null,
                    time datetime not null,
                    anonymous int(11) not null,
                    primary key (replyid))');

mysql_close($con);
?>
