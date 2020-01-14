<?php
require_once 'models/entities/user.php';

class register extends controller
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        $this->view->render('register/index');
    }

    function registerAction()
    {
        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']))
        {
            $user_name = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new user();
            $user->user_name = $user_name;
            $user->email = $email;
            $user->pass = $password;

            loadModel('user')->createUser($user);
            
            $this->redirectToDashboard();
        }
    }

    function redirectToDashboard()
    {
        header("Location: " . constant("URL") . "login");
    }
}
?>