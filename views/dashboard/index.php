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
    <?php require 'views/search.php'; ?>

    <?php
        foreach($this->posts as $post) {
            echo '
            <section class="section-post">
            
                <div class="post-container">
                    <div class="first-div">
                        <div class="category">
                            <label for="category-selector">Category</label>
                            <select name="category-selector" id="category-selector">
                                <option value="opt1">books</option>
                                <option value="opt2">movie</option>
                            </select>
                        </div>
                        <div class="title-date">
                            <div class="title">' . $post->title . '</div>
                            <div class="date">' . $post->publish_date . '</div>
                        </div>
                    </div>
                        <div class="sec-div">
                            <div class="content-text-message">' . $post->content . '</div>
                        </div>
                        <div class="third-div" >
                            <div class="author">' . $post->user->user_name . '</div>
                        </div>
                        
                        <div class="fifth-div">';
                        
                        foreach($post->comments as $comment) 
                        {
                            var_dump($comment);
                        }

                        echo '
                        <form action="' . constant("URL") . 'dashboard/comment/' . $post->post_id . '" method = "post">
                            <input type = "text" name="comment_text"></input>
                            <input type = "submit">Comment</input>
                        </form>
                        <hr>
                    </div>
                </div>
            </section>';
            
        }
    ?>

    <?php require 'views/footer.php'; ?>
</body>
</html>