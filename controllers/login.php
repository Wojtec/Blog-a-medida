<?php
class login extends controller
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        $this->view->render('login/index');
    }
}
?>