<?php
class controlpanel extends controller
{
    function __construct()
    {
        parent::__construct();
    }

    function newPost()
    {
        session_start();
        
        if(
            isset($_SESSION['user_id']) && 
            isset($_POST['new-category']) && 
            isset($_POST['tags']) && 
            isset($_POST['new-title']) && 
            isset($_POST['post-message']) && 
            isset($_POST['start-date']) && 
            isset($_POST['start-time']))
        {
            $user_id = $_SESSION['user_id'];
            $new_category = $_POST['new-category'];
            $new_title = $_POST['new-title'];
            $new_post_message = $_POST['post-message'];
            $tags = $_POST['tags'];
            $start_date = $_POST['start-date'];
            $start_time = $_POST['start-time'];

            $post = new post();
            $post->user_id = intval($user_id);
            $post->new_category = $new_category;
            $post->tags = $tags;
            $post->title = $new_title;
            $post->content = $new_post_message;
            $post->publish_date = date_add($start_date, $start_time);
            $post->start_time = $start_time;
            $post->is_public = true;

            $this->model->insertPost($post);
        }
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

        $categories = $this->model->getCategories();
        $this->view->categories = $categories;
        $this->view->render('controlpanel/index');
    }

    function editCategory($categoryId)
    {
        $categoryName = $_POST["categoryName"];
        $this->model->editCategory($categoryId, $categoryName);
        $this->render();
    }

    function removeCategory($categoryId)
    {
        $this->model->removeCategory($categoryId);
        $this->render();
    }
}
?>