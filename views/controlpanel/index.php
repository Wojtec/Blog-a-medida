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

        foreach($this->posts as $post)
        {
            echo '
                <div class="editor-box front-color">
                    <form action="' . constant("URL") . 'controlpanel/editPost/' . $post->post_id . '" method=post>
                        <div class="editor-row">
                            <p>Title</p>
                            <input type="text" name="title" value="' . $post->title . '"></input>
                        </div>

                        <div class="editor-row">
                            <p>Category</p>
                            <select name="category_id">
                            ';
                                foreach ($this->categories as $category)
                                {
                                    echo '<option value="' . $category->category_id . '" ' . ($category->category_id == $post->category_id ? "selected" : "") . '>' . $category->category_name . '</option>';
                                }
                            echo '
                            </select>
                        </div>
                        
                        <div class="editor-row">
                            <p>Published</p>
                            <select name="published">
                                <option value="true">Yes</option>
                                <option value="false">No</option>
                            </select>
                        </div>
                        
                        <div class="editor-row">
                            <p>Date and time</p>
                            <input type="datetime-local" name="datetime" value="' . date('Y-m-d\TH:i', strtotime($post->publish_date)) . '"></input>
                        </div>
                        
                        <div class="editor-row">
                            <p>Tags</p>
                            <input type="text" name="tags" value="' . $post->tags . '"></input>
                        </div>

                        <div class="editor-row">
                            <textarea name="content">' . $post->content . '</textarea>
                        </div>

                        <div class="editor-row">
                            <button type="submit">Modify</textarea>
                        </div>
                    </form>
                </div>
            ';
        }
    ?>
    
    <hr>
    
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