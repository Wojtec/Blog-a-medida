<?php

require 'models/entities/user.php';

class registerModel extends model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_user($user){
        try
        {
            $query = $this->db->connect()->prepare('insert into users (user_name, email, pass) values (:user_name, :email, :pass)');

            $query->execute([
                'user_name' => $user->user_name,
                'email' => $user->email,
                'pass' => $user->pass
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