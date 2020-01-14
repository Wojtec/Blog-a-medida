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

        echo '
            <form action="' . constant("URL") . 'controlpanel/createCategory" method="post">
                <input type="text" name="categoryName" value="New">
                <input type="submit" value="Create">
            </form>
        ';

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
   
    <form action="<?php echo constant('URL'); ?>controlpanel/createPost" method="post">
            <p>Publishing date time:</p>
            <input type="datetime-local" name="datetime">
            <p>Category</p>
            <select name="category">
                <?php
                    foreach ($this->categories as $category)
                    {
                        echo '<option>' . $category->category_name . '</option>';
                    }
                ?>
            </select>
            <p>Tags</p>
            <input type="text" name="tags">
            <p>Title</p>
            <input type="text" name="title">
            <textarea name="content" rows="10" cols="100">Text area.</textarea>    
            <input type="submit">
    </form>
    <?php require 'views/footer.php'; ?>
</body>
</html>