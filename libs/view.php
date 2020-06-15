<?php
class view
{
    function render($viewName)
    {
        require_once 'views/' . $viewName . '.php';
    }
}
?>