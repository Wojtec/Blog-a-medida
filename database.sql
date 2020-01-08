drop database if exists blog;
create database if not exists blog;

use blog;

create table posts (
	post_id			int				not null 	auto_increment,
    user_id			int				not null,
    category_id		int				not null,
    publish_date	datetime		not null,
    title			varchar(20)		not null,
    content			varchar(1000)	not null,
    is_published	bool			not null,
    primary key (post_id)
);

create table users (
	user_id			int				not null	auto_increment,
	email			varchar(30)		not null,
    pass			varchar(30)		not null,
    primary key (user_id)
);

create table post_user (
	post_id			int				not null,
    user_id			int				not null,
    primary key (post_id, user_id)
);

create table categories (
	category_id		int				not null	auto_increment,
	category_name	varchar(16)		not null,
	primary key (category_id)
);

create table comments (
	comment_id		int				not null	auto_increment,
    user_id			int				not null,	
    comment_text	varchar(200)	not null,
    primary key (comment_id)
);

create table commet_post (
	comment_id		int				not null,
    post_id			int				not null,
    primary key (comment_id, post_id)
);

create table comment_user (
	comment_id		int				not null,
    user_id			int				not null,
    primary key (comment_id, user_id)
);