<?php
class login extends controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->redirectToDashboardIfAlreadyLoggedIn();
        
        $this->view->render('login/index');
    }

    private function redirectToDashboardIfAlreadyLoggedIn()
    {
        session_start();

        if (isset($_SESSION['user_id']))
        {
            header("Location: " . constant("URL") . "dashboard");
        }
    }

    public function loginAction()
    {
        session_start();
        
        if (isset($_POST['email']) && isset( $_POST['password']) && !isset($_SESSION['user_id']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            $user = loadModel('user')->getUserByEmailPassword($email, $password);
            
            if ($user != null)
            {
                $_SESSION['user_id'] = $user->user_id;
                header("Location: " . constant("URL") . "dashboard");
            }
            else
            {
                header("Location: " . constant("URL") . "login");
            }
        }
    }

    public function logoutAction()
    {
        session_start();
        session_destroy();
        header("Location: " . constant("URL") . "login");
    }
}
?>