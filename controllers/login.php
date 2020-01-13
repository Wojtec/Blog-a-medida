<?php
class login extends controller
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        session_start();
        
        if (isset($_POST['email']) && isset( $_POST['password']) && !isset($_SESSION['user_id']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            $user = $this->model->getUserByEmailPassword($email, $password);
            
            if ($user != null)
            {
                $_SESSION['user_id'] = $user->user_id;
            }
            else
            {
                header("Location: " . constant("URL") . "login");
            }
        }

        if (isset($_SESSION['user_id']))
        {
            $user = $this->model->getUserByUserId($_SESSION['user_id']);
            $this->view->user = $user;
            echo '<p>Logged in as ' . $user->user_name . '</p>';
            header("Location: " . constant("URL") . "dashboard");
        } else {
            $this->view->render('login/index');
        }

    }

    function logout()
    {
        session_start();
        session_destroy();
        header("Location: " . constant("URL") . "login");
    }
}
?>