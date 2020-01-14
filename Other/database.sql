drop database if exists blog;
create database if not exists blog;

use blog;

create table categories (
	category_id		int				not null	auto_increment,
	category_name	varchar(16)		not null	unique,
	primary key (category_id)
);

create table users (
	user_id			int				not null	auto_increment,
    user_name		varchar(30)		not null	unique,
	email			varchar(30)		not null	unique,
    pass			varchar(30)		not null,
    primary key (user_id)
);

create table posts (
	post_id			int				not null 	auto_increment,
    user_id			int				not null,
    category_id		int				not null,
    publish_date	datetime 		not null	default now(),
    title			varchar(100)	not null,
    content			varchar(2000)	not null,
    is_public		bool			not null,
    tags			varchar(1000)	not null	default '',
    primary key (post_id),
    foreign key (user_id) references users(user_id) on delete cascade,
    foreign key (category_id) references categories(category_id) on delete cascade
);

create table comments (
	comment_id		int				not null	auto_increment,
    user_id			int,
    post_id			int				not null,
    comment_text	varchar(200)	not null,
    comment_date	datetime		default now(),
    primary key (comment_id),
    foreign key (user_id) references users(user_id) on delete cascade,
    foreign key (post_id) references posts(post_id) on delete cascade
);