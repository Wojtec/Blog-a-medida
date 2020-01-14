<?php
class dashboard extends controller
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
        }
        $posts = $this->model->getPosts();
        $this->view->posts = $posts;
        $this->view->render('dashboard/index');
    }

    function comment($post_id)
    {
        session_start();

        $userId = null;

        if (isset($_SESSION["user_id"]))
        {
            $userId = $_SESSION["user_id"];
        }

        $comment_text = $_POST["comment_text"];

        $this->model->commentPostByPostId($post_id, $userId, $comment_text);
        
        header("Location: " . constant("URL") . "dashboard");
    }

    function search()
    {
        // TODO: Handle invalid searches
        $target = $_GET["target"];

        $posts = $this->model->getPostsByContent($target);
        $this->view->posts = $posts;
        $this->view->render('dashboard/index');
    }
}
?>