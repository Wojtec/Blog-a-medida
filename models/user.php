<?php
class User {
    
    public $user_id;
    public $email;
    public $pass;

    function __construct($user_id,$email,$pass){
        $this->user_id = $user_id;
        $this->email = $email;
        $this->pass = $pass;
    }
}
?>