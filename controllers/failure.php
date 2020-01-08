<?php
class failure extends controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->render('failure/index');
        echo "error";
    }
}
?>