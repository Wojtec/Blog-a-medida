<?php

function loadModel($model)
{
    $modelPath = 'models/' . $model . 'model.php';
    require_once $modelPath;
    $modelClassName = $model . 'model';
    $model = new $modelClassName;
    return $model;
}

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

        require_once 'controllers/' . $url[0] . '.php';
        $controller = new $url[0];

        if (isset($url[1]))
        {
            if (isset($url[2]))
            {
                $controller->{ $url[1] . 'Action' }( $url[2] );
            }
            else
            {
                $controller->{ $url[1] . 'Action' }();
            }
        }
        else
        {
            $controller->render();
        }

    }
}

    

?>