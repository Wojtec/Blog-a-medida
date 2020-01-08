<?php
class Comment{
public $comment_id;
public $user_id;
public $post_id;
public $comment_text;
public $comment_date;

function __construct($comment_id,$user_id,$post_id,$comment_text,$comment_date){
    $this->comment_id = $comment_id;
    $this->user_id = $user_id;
    $this->post_id = $post_id;
    $this->comment_text = $comment_text;
    $this->comment_date = $comment_date;
}
}


?>