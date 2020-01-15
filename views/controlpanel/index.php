<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo constant("URL"); ?>public/styles/reset.css">
    <link rel="stylesheet" href="<?php echo constant("URL"); ?>public/styles/base-style.css">
    <link rel="stylesheet" href="<?php echo constant("URL"); ?>public/styles/layout.css">
    <title>Blog</title>
</head>
<body class="back-color">
    <?php require 'views/header.php'; ?>


    <div class="category-box front-color">
        <p class="section-title">Category management</p>
        <?php
            foreach($this->categories as $category)
            {
                echo '
                    <form class="category" action="' . constant("URL") . 'controlpanel/editCategory/' . $category->category_id . '" method="post">
                        <input type="text" name="categoryName" value="' . $category->category_name . '">
                        <input type="submit" value="Edit">
                        <p><a href="' . constant("URL") . 'controlpanel/removeCategory/' . $category->category_id . '">Remove</a></p>
                    </form>
                ';
            }
            echo '
                <form class="category" action="' . constant("URL") . 'controlpanel/createCategory" method="post">
                    <input type="text" name="categoryName" placeholder="write a new category here">
                    <input type="submit" value="Create">
                </form>
            ';
        ?>
    </div>

    <hr>

    <?php
        foreach($this->userPosts as $userPost)
        {
            var_dump($userPost);
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