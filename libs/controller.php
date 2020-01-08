<?php
class Controller
{
    function __construct()
    {
        echo "Base controller";
        $this->view = new view();
    }
}
?>