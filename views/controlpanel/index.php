<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/reset.css">
    <title>Blog</title>
</head>
<body>
    <?php require 'views/header.php'; ?>

    <p>Categories</p>

    <?php
        foreach($this->categories as $category)
        {
            echo '
                <form action="' . constant("URL") . 'controlpanel/editCategory/' . $category->category_id . '" method="post">
                    <input type="text" name="categoryName" value="' . $category->category_name . '">
                    <input type="submit" value="Edit">
                    <p><a href="' . constant("URL") . 'controlpanel/removeCategory/' . $category->category_id . '">Remove</a></p>
                </form>
            ';
        }
    ?>

    <hr>

    <?php
        foreach($this->userPosts as $userPost)
        {
            var_dump($userPost);
            echo '
            <p> "'. $userPost->title .'"</p>
            <p> "'. $userPost->content .'"</p>
            <p> "'. $userPost->tags .'"</p>
            ';
        }
    ?>
   
    <form action="<?php echo constant('URL'); ?>controlpanel/newPost" method="post">
             <label for="start-date">Start date:</label>
            <input type="date" id="start-date" name="start-date">
            <input type="time" id="start-time" name="start-time">
            <label for="new-catgory">Category</label>
            <input type="text" name="new-category">
            <label for="new-catgory">Tags</label>
            <input type="text" name="tags">
            <label for="new-title">Title</label>
            <input type="text" name="new-title">
            <textarea name="post-message" rows="10" cols="100">Text area.</textarea>    
            <input type="submit" name="subit-new-post">
    </form>
    <?php require 'views/footer.php'; ?>
</body>
</html>