<?php
require_once "controllers/failure.php";

class app
{
    function __construct()
    {
        $url = $_GET["url"];
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        $controllerName = $url[0];
        $controllerPath = 'controllers/' . $controllerName . '.php';

        if (file_exists($controllerPath))
        {
            require_once $controllerPath;
            $controller = new $controllerName;

            if (isset($url[1]))
            {
                echo "CHw!";
                $controller->{$url[1]}();
            }
            else
            {
                echo "CHA!";
            }
        }
        else
        {
            $controller = new failure();
        }

    }
}

    

?>