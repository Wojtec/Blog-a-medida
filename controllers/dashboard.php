<?php
class dashboard extends controller
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        $posts = $this->model->getPosts();
        $this->view->render('dashboard/index');
    }
}
?>