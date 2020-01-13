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

        var_dump($post);


    }



}

?>