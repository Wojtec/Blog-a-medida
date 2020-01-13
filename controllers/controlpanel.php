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
            $this->view->render('login/index');
        }

        $this->view->render('controlpanel/index');
    }
}
?>