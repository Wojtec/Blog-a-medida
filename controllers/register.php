<?php
class register extends controller
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        if (isset($_POST['userName']) && isset($_POST['emailName']) && isset($_POST['password']))
        {
            $user_name = $_POST['userName'];
            $email = $_POST['emailName'];
            $password = $_POST['password'];

            $user = new user();
            $user->user_name = $user_name;
            $user->email = $email;
            $user->pass = $password;

            $this->model->insert_user($user);
            
            header("Location: " . constant("URL") . "login");
        }

        $this->view->render('register/index');
    }
}
?>