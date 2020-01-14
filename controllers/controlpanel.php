<?php
class controlpanel extends controller
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        session_start();

        if (isset($_SESSION['user_id']))
        {
            $user = $this->model->getUserByUserId($_SESSION['user_id']);
            $this->view->user = $user;
        } else {
            header("Location: " . constant("URL") . "login");
        }

        if(isset($_SESSION['user_id']) && isset($_POST['new-category']) && isset($_POST['tags']) && isset($_POST['new-title']) && isset($_POST['post-message'])&& isset($_POST['start-date']))
        {
            $user_id = $_SESSION['user_id'];
            $new_category = $_POST['new-category'];
            $new_title = $_POST['new-title'];
            $new_post_message = $_POST['post-message'];
            $tags = $_POST['tags'];
            $start_date = $_POST['start-date'];


            $post = new post();
            $post->user_id = intval($user_id);
            $post->new_category = $new_category;
            $post->tags = $tags;
            $post->title = $new_title;
            $post->content = $new_post_message;
            $post->publish_date = $start_date;
            $post->is_public = true;

            $this->model->insertPost($post);


        }




        $this->view->render('controlpanel/index');
    }
}
?>