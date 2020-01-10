<?php
class controlpanel extends controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->render('controlpanel/index');
    }

    function methodA()
    {
        echo "A Procedure";
    }
}
?>