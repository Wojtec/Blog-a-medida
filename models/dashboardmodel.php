<?php

require 'models/entities/category.php';
require 'models/entities/comment.php';
require 'models/entities/post.php';
require 'models/entities/user.php';

class dashboardModel extends model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPosts()
    {
        $posts = [];

        try{
            $query = $this->db->connect()->query('
            select * from posts
            inner join users on posts.user_id = users.user_id
            where publish_date < now() and is_public = true
            order by publish_date;');
            
            
            while($row = $query->fetch()){
                $post = new post();
                $post->post_id = $row['post_id'];
                $post->user_id    = $row['user_id'];
                $post->category_id  = $row['category_id'];
                $post->publish_date  = $row['publish_date'];
                $post->title  = $row['title'];
                $post->content  = $row['content'];
                $post->is_public  = $row['is_public'];
                array_push($posts, $post);
            }
            
            return $posts;
        }catch(PDOException $e){
            echo "sql error " . $e.getMessage();
            return [];
        }
    }
}

?>