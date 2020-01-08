<?php
class view
{
    function __construct()
    {
        echo "View controller";
    }

    function render($viewName)
    {
        require 'views/' . $viewName . '.php';
    }
}
?>