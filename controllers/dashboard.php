<?php
class dashboard extends controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->loadUserNameIntoViewIfLoggedIn();
        $this->loadPublishedPostsIntoView();
        $this->loadCategoriesIntoView();
        
        $this->view->render('dashboard/index');
    }

    private function loadCategoriesIntoView()
    {
        $this->view->categories = loadModel("category")->getCategories();
    }

    private function loadUserNameIntoViewIfLoggedIn()
    {
        session_start();

        if (isset($_SESSION['user_id']))
        {
            $user = loadModel('user')->getUserByUserId($_SESSION['user_id']);
            $this->view->user = $user;
        }
    }

    private function loadPublishedPostsIntoView()
    {
        $this->view->posts = loadModel('post')->getPublishedPosts();
    }

    public function commentAction($post_id)
    {
        session_start();

        $userId = null;

        if (isset($_SESSION["user_id"]))
        {
            $userId = $_SESSION["user_id"];
        }
        
        loadModel('post')->commentPostByPostId($post_id, $userId, $_POST["comment_text"]);
        
        header("Location: " . constant("URL") . "dashboard");
    }

    public function searchAction()
    {
        // TODO: Handle invalid searches
        $target = $_GET["target"];

        $this->view->posts = loadModel("post")->getPostsByContent($target);
        $this->view->render('dashboard/index');
    }
}
?>