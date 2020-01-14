<?php
require_once 'models/entities/comment.php';
require_once 'models/entities/post.php';
require_once 'models/entities/user.php';

class postmodel extends model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPostsFilteredByCategoryName($catFilter){
        $filterPost = [];
        try
        {
            $query = $this->db->connect()->query('select * from posts where posts.category_id = ' . $catFilter.'');
            if(!$query) return null;

            while($row = $query->fetch()){
                $filPost = new post();
                $filPost->category_id = $row['category_id'];
                $filPost->publish_date = $row['publish_date'];
                $filPost->title = $row['title'];
                $filPost->content = $row['content'];
                array_push($filterPost,$filPost);
            }
        }
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
            return null;
        }
        var_dump($filterPost);
        return $filterPost;
    }
    //get posts with comments
    public function getPostWithComments($user_id){
        $postsCommentsArray = [];
        try
        {
            $query = $this->db->connect()->query('select * from posts, comments where posts.user_id = ' . intval($user_id) .' and comments.user_id = ' . intval($user_id) .';');

            if(!$query) return null;
            while($row = $query->fetch()){
                $comPost = new post();
                $comPost->user_id = $row['user_id'];
                $comPost->category_id = $row['category_id'];
                $comPost->publish_date = $row['publish_date'];
                $comPost->title = $row['title'];
                $comPost->content = $row['content'];
                array_push($postsCommentsArray,$comPost);

                $comPost = new comment();
                $comPost->user_id = $row['user_id'];
                $comPost->publish_date = $row['comment_date'];
                $comPost->comment_text = $row['comment_text'];
                array_push($postsCommentsArray,$comPost);

            }
        
            var_dump($postsCommentsArray);

        
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
            $query = $this->db->connect()->prepare('insert into posts (user_id, category_id, title, content, is_public, tags, publish_date) values (' . intval($post->user_id) . ', ' . intval($post->category_id) . ', "' . $post->title . '", "' . $post->content . '", ' . $post->is_public . ', "' . $post->tags . '", "' . $post->publish_date->format('Y-m-d H:i:s') . '")');
    
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

    public function commentPostByPostId($postId, $userId, $commentText)
    {
        try
        {

            
            $query = $this->db->connect()->prepare('insert into comments (user_id, post_id, comment_text) values (:user_id, :post_id, :comment_text)');
            
            $query->execute([
                'post_id' => intval($postId),
                'user_id' => isset($userId) ? intval($userId) : null,
                'comment_text' => $commentText
            ]);
        }
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
            return [];
        }
    }

    public function getPublishedPosts()
    {
        $posts = [];

        try
        {
            $query = $this->db->connect()->query('
            select * from posts
            inner join users on posts.user_id = users.user_id
            where publish_date < now() and is_public = true
            order by publish_date;');

            if (!$query) return [];
            
            while($row = $query->fetch()){
                $post = new post();
                $post->post_id = $row['post_id'];
                $post->user_id    = $row['user_id'];
                $post->category_id  = $row['category_id'];
                $post->publish_date  = $row['publish_date'];
                $post->title  = $row['title'];
                $post->content  = $row['content'];
                $post->is_public  = $row['is_public'];
                $post->tags  = $row['tags'];
                array_push($posts, $post);
            }
            
            $commentModel = loadModel('comment');
            $userModel = loadModel('user');

            foreach ($posts as $post)
            {
                $post->comments = $commentModel->getCommentsFromPostId($post->post_id);
                $post->user = $userModel->getUserByUserId($post->user_id);

                foreach ($post->comments as $comment)
                {
                    if ($comment->user_id != null)
                    {
                        $comment->user = $userModel->getUserByUserId($comment->user_id);
                    }
                }
            }

            return $posts;
        }
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
            return [];
        }
    }

    public function getPostsByContent($target)
    {
        $posts = [];

        try
        {
            $query = $this->db->connect()->query('
            select * from posts
                where 
                    (
                    title           like "%' . $target . '%" or 
                    content	    	like "%' . $target . '%" or
                    tags            like "%,' . $target . ',%"
                    ) and
                    publish_date	< now() and
                    is_public		= true;');

            if (!$query) return [];
            
            while($row = $query->fetch()){
                $post = new post();
                $post->post_id = $row['post_id'];
                $post->user_id    = $row['user_id'];
                $post->category_id  = $row['category_id'];
                $post->publish_date  = $row['publish_date'];
                $post->title  = $row['title'];
                $post->content  = $row['content'];
                $post->is_public  = $row['is_public'];
                $post->tags  = $row['tags'];
                array_push($posts, $post);
            }
            
            foreach ($posts as $post)
            {
                $post->comments = loadModel("comment")->getCommentsFromPostId($post->post_id);
                $post->user = loadModel("user")->getUserByUserId($post->user_id);

                foreach ($post->comments as $comment)
                {
                    if ($comment->user_id != null)
                    {
                        $comment->user = loadModel("user")->getUserByUserId($comment->user_id);
                    }
                }
            }

            return $posts;
        }
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
            return [];
        }
    }
}



?>