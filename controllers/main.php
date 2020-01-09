<?php
class main extends controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->render('main/index');
    }
}
?>