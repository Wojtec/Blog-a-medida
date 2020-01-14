<?php
class controlpanel extends controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
    }

    function newPostAction() // Finish this
    {
        session_start();
        
        if(
            isset($_SESSION['user_id']) && 
            isset($_POST['new-category']) && 
            isset($_POST['tags']) && 
            isset($_POST['new-title']) && 
            isset($_POST['post-message']) && 
            isset($_POST['start-date']) && 
            isset($_POST['start-time']))
        {
            $user_id = $_SESSION['user_id'];
            $new_category = $_POST['new-category'];
            $new_title = $_POST['new-title'];
            $new_post_message = $_POST['post-message'];
            $tags = $_POST['tags'];
            $start_date = $_POST['start-date'];
            $start_time = $_POST['start-time'];

            $post = new post();
            $post->user_id = intval($user_id);
            $post->new_category = $new_category;
            $post->tags = $tags;
            $post->title = $new_title;
            $post->content = $new_post_message;
            $post->publish_date = date_add($start_date, $start_time);
            $post->start_time = $start_time;
            $post->is_public = true;

            $this->model->insertPost($post);
        }
    }

    function render()
    {
        $this->redirectToLoginIfNotLoggedIn();
        $this->loadUserNameIntoView();
        $this->loadCategoriesIntoView();
        $this->loadUserPosts();
        $this->loadPostCommentedInToView();
        $this->view->render('controlpanel/index');
    }
    private function loadPostCommentedInToView(){

        $this->view->userId = loadModel("post")->getPostWithComments($_SESSION['user_id']);
    }

    private function loadUserPosts()
    {
        $this->view->userPosts = loadModel("post")->getUserPosts($_SESSION['user_id']);
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
}
?>