<?php
class view
{
    function render($viewName)
    {
        require 'views/' . $viewName . '.php';
    }
}
?>