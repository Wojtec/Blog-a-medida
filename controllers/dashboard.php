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

    private function reloadPage()
    {
        header("Location: " . constant("URL") . "dashboard");
    }

    public function commentAction($post_id)
    {
        session_start();

        $userId = null;

        if (isset($_SESSION["user_id"]))
        {
            $userId = $_SESSION["user_id"];
        }
        
        loadModel('post')->commentPostByPostId($post_id, $userId, $_POST["comment-text"]);
        
        $this->reloadPage();
    }

    public function searchAction()
    {
        $target = $_GET["target"];

        $this->loadUserNameIntoViewIfLoggedIn();
        $this->view->posts = loadModel("post")->getPostsByContent($target);
        $this->loadCategoriesIntoView();
        
        $this->view->render('dashboard/index');
    }

    public function deleteAction($comment_id)
    {
        session_start();

        if (!isset($_SESSION["user_id"]))
        {
            $this->reloadPage();
        }

        $comment_model = loadModel("comment");

        $comment = $comment_model->getCommentById($comment_id);
        $user = loadModel("user")->getUserByUserId($comment->user_id);

        if ($user->user_id != $_SESSION["user_id"])
        {
            $this->reloadPage();
        }

        $comment_model->deleteCommentById($comment_id);
        
        $this->reloadPage();
    }

    public function filterPostsAction()
    {
        $category_id = $_GET["category_id"];

        $this->loadUserNameIntoViewIfLoggedIn();
        $this->view->posts = loadModel("post")->getPostsByCategoryId($category_id);
        $this->loadCategoriesIntoView();
        
        $this->view->render('dashboard/index');
    }
}
?>