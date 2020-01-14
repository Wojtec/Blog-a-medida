<?php

require 'models/entities/category.php';
require 'models/entities/post.php';
require 'models/entities/user.php';

class controlpanelModel extends model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserByUserId($userId)
    {
        try
        {
            $query = $this->db->connect()->query('
            select * from users
            where user_id = ' . $userId . ';
            ');

            if (!$query) return null;

            $row = $query->fetch();

            $user = new user();
            $user->user_id = $row['user_id'];
            $user->user_name    = $row['user_name'];
            $user->email  = $row['email'];
            $user->pass  = $row['pass'];
            
            return $user;
        }
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
            return null;
        }
    }

    public function insertPost($post){

        try
        {
            $query = $this->db->connect()->prepare('insert into posts (user_id, title, content, is_public, tags, publish_date) values (:user_id, :title, :content, :is_public,:tags, :publish_date)');

            $query->execute([
                'user_id' => $post->user_id,
                'title' => $post->title,
                'content' => $post->content,
                'is_public' => $post->is_public,
                'tags' => $post->tags,
                'publish_date' => $post->publish_date
            ]);

        }
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
            return null;
        }


    }



}

?>