<?php
require_once "controllers/failure.php";

class app
{
    function __construct()
    {
        if (!isset($_GET["url"]))
        {
            $_GET["url"] = "dashboard";
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
            $controller->loadModel($controllerName);

            if (isset($url[1]))
            {
                if (isset($url[2]))
                {
                    $controller->{ $url[2] }();
                }
                else
                {
                    $controller->{ $url[1] }();
                }
            }
            else
            {
                $controller->render();
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