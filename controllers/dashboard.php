<?php
class dashboard extends controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->render('dashboard/index');
    }
}
?>