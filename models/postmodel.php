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

    public function modifyPost($post_id, $post)
    {
        try
        {
            $string = '
            update posts 
                set 
                    user_id = ' .           $post->user_id . ', 
                    category_id = ' .       $post->category_id . ', 
                    title = "' .             $post->title . '", 
                    content = "' .           $post->content . '", 
                    is_public = ' .         $post->is_public . ', 
                    tags = "' .              $post->tags . '", 
                    publish_date = "' .      $post->publish_date->format('Y-m-d H:i:s') . '"
                        where post_id = ' . $post_id . ';';

            $query = $this->db->connect()->prepare('
                update posts 
                    set 
                        user_id = ' .           $post->user_id . ', 
                        category_id = ' .       $post->category_id . ', 
                        title = "' .             $post->title . '", 
                        content = "' .           $post->content . '", 
                        is_public = ' .         $post->is_public . ', 
                        tags = "' .              $post->tags . '", 
                        publish_date = "' .      $post->publish_date->format('Y-m-d H:i:s') . '"
                            where post_id = ' . $post_id . ';');
    
            $query->execute();
    
        }
        catch(PDOException $e)
        {
            echo "sql error " . $e.getMessage();
        }
    }

    public function getPostsByCategoryId($category_id){
        $posts = [];
        
        try
        {
            $query = $this->db->connect()->query('select * from posts where posts.category_id = ' . $category_id.' and publish_date < now() and is_public = true order by publish_date;');
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
            $categoryModel = loadModel('category');

            foreach ($posts as $post)
            {
                $post->comments = $commentModel->getCommentsFromPostId($post->post_id);
                $post->user = $userModel->getUserByUserId($post->user_id);
                $post->category = $categoryModel->getCategoryById($post->category_id);

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
            return null;
        }
    }

    public function getPostById($post_id)
    {
        try
        {
            $query = $this->db->connect()->query('select * from posts where post_id = ' . $post_id . ';');

            $row = $query->fetch();

            $post = new post();
            $post->post_id = $row['post_id'];
            $post->user_id    = $row['user_id'];
            $post->category_id  = $row['category_id'];
            $post->publish_date  = $row['publish_date'];
            $post->title  = $row['title'];
            $post->content  = $row['content'];
            $post->is_public  = $row['is_public'];
            $post->tags  = $row['tags'];

            return $post;
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
    
    public function getPostsByUserId($userId){
        $posts = [];
        try
        {
            $query = $this->db->connect()->query('
            select * from posts
            where user_id = ' . intval($userId) . ';
            ');
            if(!$query) return null;
        while ($row = $query->fetch()){
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
            return $posts;
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
            $categoryModel = loadModel('category');

            foreach ($posts as $post)
            {
                $post->comments = $commentModel->getCommentsFromPostId($post->post_id);
                $post->user = $userModel->getUserByUserId($post->user_id);
                $post->category = $categoryModel->getCategoryById($post->category_id);

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
            
            $commentModel = loadModel('comment');
            $userModel = loadModel('user');
            $categoryModel = loadModel('category');
            
            foreach ($posts as $post)
            {
                $post->comments = $commentModel->getCommentsFromPostId($post->post_id);
                $post->user = $userModel->getUserByUserId($post->user_id);
                $post->category = $categoryModel->getCategoryById($post->category_id);

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
}



?>