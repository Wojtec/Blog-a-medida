<?php
class core extends controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->render('core/index');
        echo "main";
    }

    function methodA()
    {
        echo "A Procedure";
    }
}
?>