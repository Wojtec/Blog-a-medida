<?php
class view
{
    function __construct()
    {
        
    }

    function render($viewName)
    {
        require 'views/' . $viewName . '.php';
    }
}
?>