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

    public function getCategories()
    {
        $categories = [];

        try
        {
            $query = $this->db->connect()->query('
            select * from categories;');

            if (!$query) return [];
            
            while($row = $query->fetch()){
                $category = new category();
                $category->category_id = $row['category_id'];
                $category->category_name = $row['category_name'];
                array_push($categories, $category);
            }

            return $categories;
        }
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
            return [];
        }
    }

    public function editCategory($categoryId, $categoryName)
    {
        try
        {
            $query = $this->db->connect()->prepare('update categories set category_name = "' . $categoryName . '" where category_id = ' . intval($categoryId) . '');

            $query->execute();
        }
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
        }
    }

    public function removeCategory($categoryId)
    {
        try
        {
            $query = $this->db->connect()->prepare('delete from categories where category_id = ' . intval($categoryId) . '');

            $query->execute();
        }
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
        }
    }

    public function getUserPosts($userId){
        $postsArray = [];
        try
        {
            $query = $this->db->connect()->query('
            select * from posts
            where user_id = ' . intval($userId) . ';
            ');
            if(!$query) return null;
        while ($row = $query->fetch()){
            $posts = new post();
            $posts->user_id = $row['user_id'];
            $posts->category_id = $row['category_id'];
            $posts->publish_date = $row['publish_date'];
            $posts->title = $row['title'];
            $posts->content = $row['content'];
            $posts->tags = $row['tags'];
            array_push($postsArray,$posts);
        }
            return $postsArray;
        }
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
            return null;
        }
    }
}

?>