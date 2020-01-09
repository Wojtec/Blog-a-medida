<?php
require_once "controllers/failure.php";

class app
{
    function __construct()
    {
        if (!isset($_GET["url"]))
        {
            $_GET["url"] = "main";
        }

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
                $controller->{$url[1]}();
            }
        }
        else
        {
            $errorMsg = "Could not find a controller named " . $controllerName;
            $controller = new failure($errorMsg);
        }

    }
}

    

?>