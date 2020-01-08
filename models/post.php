<?php
    class Post {
        public $post_id;
        public $user_id;
        public $category_id;
        public $publish_date;
        public $title;
        public $content;
        public $is_published;
        
        function __construct($post_id,$user_id,$category_id,$publish_date,$title,$content,$is_published){
            $this->post_id = $post_id;
            $this->user_id = $user_id;
            $this->category_id = $category_id;
            $this->publish_date = $publish_date;
            $this->title = $title;
            $this->content = $content;
            $this->is_published = $is_published;
        }
    }
?>