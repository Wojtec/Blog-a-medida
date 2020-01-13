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
        $this->view->render('dashboard/index');
    }
}
?>