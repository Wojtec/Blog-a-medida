<?php
class register extends controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->render('register/index');
    }

    function methodA()
    {
        echo "A Procedure";
    }
}
?>