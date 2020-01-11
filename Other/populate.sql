use blog;

delete from categories;
delete from users;

insert ignore into categories (category_id, category_name)
values (1, 'Aliens'), (2, 'Space'), (3, 'Coding');

insert ignore into users (user_id, user_name, email, pass)
values 
(1, 'Wojtek', 'wojland@poland.pl', '1234secure'), 
(2, 'Axel', 'axel@pokeballs.es', '1234'), 
(3, 'Emily the Rat', 'cheese@rathouse.rt', 'cheese');

insert ignore into posts (post_id, user_id, category_id, publish_date, title, content, is_public)
values 
(1, 3, 1, '2019/1/14', "Aliens in cheese planet", "Look at my sister woah, a lot of cheese then laser war, then my cheese. Yeah plus minus okay? bro.", true), 
(2, 1, 2, '2019/1/14', "If you dont like to code you can always dedicate to something less skilled.", "Yeah sure, you can always have to possibility of being a janitor. So do not be sad.", true), 
(3, 1, 2, '2019/1/14', "If you dont like to code you can always dedicate to something less skilled.", "Yeah sure, you can always have to possibility of being a janitor. So do not be sad.", true), 
(4, 2, 3, '2020/1/14', "Shiba inu the best dogs", "Hey yeah they woof a lot and the sleep sometimes you know. Then they woof at wake up and make stuff woofing all day bro.", true),
(5, 2, 3, '2020/1/10', "Shiba inu the best dogs", "Hey yeah they woof a lot and the sleep sometimes you know. Then they woof at wake up and make stuff woofing all day bro.", true);

insert ignore into comments (comment_id, user_id, post_id, comment_text, comment_date)
values
(1, 1, 1, "Wojtek is awesome heee hee", '2020/1/14'),
(2, 1, 1, "Yeah Im awesome heeeeee", '2020/1/14'),
(3, 1, 2, "Hey Im perferfdjidjisf", '2020/1/14'),
(4, 2, 2, "Hi hee", '2020/1/14'),
(5, null, 3, "wtf is this website", '2020/1/14'),
(6, 2, 3, "hee hee", '2020/1/14'),
(7, 3, 3, "where is my cheese?", '2020/1/14');

select * from categories;
select * from posts;
select * from comments;
select * from users;