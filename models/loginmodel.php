<?php

require 'models/entities/user.php';

class loginmodel extends model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserByEmailPassword($email, $password)
    {
        try
        {
            $query = $this->db->connect()->query('
            select * from users
            where email = "' . $email . '" and pass = "' . $password . '";'
            );

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
            return null;
        }
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
}

?>