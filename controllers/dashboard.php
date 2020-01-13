<?php
class dashboard extends controller
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        if (isset($_POST['email']) && isset( $_POST['password']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            var_dump($email);
            var_dump($password);
    
            $user = $this->model->getUserByEmailPassword($email, $password);
            
            var_dump($user);
        }

        $posts = $this->model->getPosts();
        $this->view->render('dashboard/index');
    }
}
?>