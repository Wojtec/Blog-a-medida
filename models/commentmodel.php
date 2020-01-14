<?php
require_once 'models/entities/comment.php';
require_once 'models/entities/post.php';

class commentmodel extends model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCommentsFromPostId($postId)
    {
        $comments = [];

        try
        {
            $query = $this->db->connect()->query('
            select * from comments
            where post_id = ' . $postId . ';
            ');

            if (!$query) return [];
            
            while($row = $query->fetch()){
                $comment = new comment();
                $comment->comment_id = $row['comment_id'];
                $comment->user_id    = $row['user_id'];
                $comment->post_id  = $row['post_id'];
                $comment->comment_text  = $row['comment_text'];
                $comment->comment_date  = $row['comment_date'];
                array_push($comments, $comment);
            }
            
            return $comments;
        }
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
            return [];
        }
    }
}

?>