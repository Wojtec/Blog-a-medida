<?php
class controlpanel extends controller
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        $this->view->render('controlpanel/index');
    }
}
?>