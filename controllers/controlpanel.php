<?php
require_once 'models/entities/post.php';

class controlpanel extends controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
    }

    function createPostAction()
    {
        $categories = loadModel("category")->getCategories();
        $requestedCategoryName = $_POST['category'];

        $categoryId = null;

        foreach ($categories as $category)
        {
            if (strcmp($category->category_name, $requestedCategoryName) == 0)
            {
                $categoryId = $category->category_id;
            }
        }

        $post = new post();
        $post->user_id = $_SESSION['user_id'];
        $post->category_id =  $categoryId;
        $post->tags = $_POST['tags'];
        $post->title = $_POST['title'];
        $post->content = $_POST['content'];
        $post->publish_date = new DateTime($_POST['datetime']);
        $post->is_public = true;

        loadModel("post")->insertPost($post);   
        $this->redirectToControlPanel();
    }

    function render()
    {
        $this->redirectToLoginIfNotLoggedIn();
        $this->loadUserNameIntoView();
        $this->loadCategoriesIntoView();
        $this->loadUserPosts();
        $this->view->render('controlpanel/index');
    }

    private function loadUserPosts()
    {
        $this->view->posts = loadModel("post")->getPostsByUserId($_SESSION['user_id']);
    }

    private function loadCategoriesIntoView()
    {
        $this->view->categories = loadModel("category")->getCategories();
    }

    private function loadUserNameIntoView()
    {
        $this->view->user = loadModel('user')->getUserByUserId($_SESSION['user_id']);
    }

    private function redirectToLoginIfNotLoggedIn()
    {
        if (!isset($_SESSION['user_id']))
        {
            header("Location: " . constant("URL") . "login");
        }
    }

    private function redirectToControlPanel()
    {
        header("Location: " . constant("URL") . "controlpanel");
    }

    function editCategoryAction($categoryId)
    {
        loadModel("category")->editCategory($categoryId, $_POST["categoryName"]);
        $this->redirectToControlPanel();
    }

    function removeCategoryAction($categoryId)
    {
        loadModel("category")->removeCategory($categoryId);
        $this->redirectToControlPanel();
    }

    function createCategoryAction()
    {
        loadModel("category")->createCategory($_POST["categoryName"]);
        $this->redirectToControlPanel();
    }
}
?>