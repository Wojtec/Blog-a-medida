use blog;

select * from posts
inner join users on posts.user_id = users.user_id
where publish_date < now() and is_public = false
order by publish_date;