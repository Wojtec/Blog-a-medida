use blog;

-- Get all categories
select * from categories;

-- Modify a category
update 	categories
set		category_name = x
where	category_id = y;

-- Delete a category
delete from category
where		category_id = x;

-- Create a category
insert into category (category_name)
values (x);

-- Create new user
insert into users (user_name, email, pass)
values (x, y, z);

-- This will show in the public dashboard
-- Selecting all the published post which publish date is lesser than the current date
select * from posts
inner join users on posts.user_id = users.user_id
where publish_date < now() and is_public = true
order by publish_date;

-- Retrieve all the comments from a post
select * from comments
where post_id = x;

-- This will show in the control panel
-- Check password and return user and all its posts
select * from users
inner join posts on users.user_id = posts.user_id
where user_name = x and pass = y;

-- Modify an existing post given the post_id
update posts
set category_id = a, publish_date = b, title = c, content = d, is_public = e
where post_id = x;

-- Placing a new comment in a post logged in given the post_id
insert into comments (user_id, post_id, comment_text, comment_date)
values (x, y, z, xx);

-- Placing a new comment in a post anonymously given the post_id
insert into comments (post_id, comment_text, comment_date)
values (x, y, z);

-- Show posts that contains X string in title || content || tags
select * from posts
where 
    (
    title           like '%X%' or 
    content	    	like '%X%' or
    tags            like '%,X,%'
    ) and
    publish_date	< now() and
    is_public		= true;