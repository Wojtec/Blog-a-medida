<?php
class failure extends controller
{
    function __construct($errorMsg)
    {
        parent::__construct();
        $this->view->errorMsg = $errorMsg;
        $this->view->render('failure/index');
    }
}
?>