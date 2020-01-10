<?php
class register extends controller
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        $this->view->render('register/index');
    }
}
?>