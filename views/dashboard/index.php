<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/styles/reset.css">
    <link rel="stylesheet" href="public/styles/base-style.css">
    <link rel="stylesheet" href="public/styles/layout.css">
    <title>Blog</title>
</head>
<body class="back-color">
    <?php require 'views/header.php'; ?>
    <?php require 'views/search.php'; ?>
    <?php require 'views/category-filter.php'; ?>

    <?php
        foreach($this->posts as $post) {

            /*
                echo '
                    <div class="post-box front-color">
                        <p class="post-title">Title</p>
                        <p class="post-category">Category</p>
                        <p class="post-date">13/01/2020</p>
                        <p class="post-content">Hey bro hi I wanna just gonna you know wanna gonna do this after you know dude hey hee hee well I am very you know because hee hee</p>
                        <p class="post-sign">Posted by Axel</p>
                        <div class="comment-box">
                            <p class="comment-author">Wojtek says: </p>
                            <p class="comment-text">Hey how is it going bro</p>
                            <p class="comment-date">Commented in 13/01/2020</p>
                        </div>
                        <div class="comment-box">
                            <p class="comment-author">Wojtek says: </p>
                            <p class="comment-text">Hey how is it going bro</p>
                            <p class="comment-date">Commented in 13/01/2020</p>
                        </div>
                        <form class="comment-input-container" action="" method=post>
                            <input class="comment-input" type="text" placeholder="something to say about this?" name="comment-text">
                            <button type="submit">comment</button>
                        </form>
                    </div>
                ';
            */

            echo '
                <div class="post-box front-color">
                    <p class="post-title">' . $post->title . '</p>
                    <p class="post-category">' . $post->category->category_name . '</p>
                    <p class="post-date">' . $post->publish_date . '</p>
                    <p class="post-content">' . $post->content . '</p>
                    <p class="post-sign">Posted by ' . $post->user->user_name . '</p>
                    ';

                    foreach ($post->comments as $comment)
                    {
                        echo '
                        <div class="comment-box">
                            <p class="comment-author">' . (isset($comment->user) ? $comment->user->user_name : 'Anonymous') . ' says: </p>
                            <p class="comment-text">' . $comment->comment_text . '</p>
                            <p class="comment-date">Commented in ' . $comment->comment_date . '</p>
                        </div>
                        ';
                    }

                    echo '
                    <form class="comment-input-container" action="' . constant("URL") . 'dashboard/comment/' . $post->post_id . '" method=post>
                        <input class="comment-input" type="text" placeholder="something to say about this?" name="comment-text">
                        <button type="submit">comment</button>
                    </form>
                </div>
            ';

            /*echo '
            
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
                </div>';*/
            
        }
    ?>

    <?php require 'views/footer.php'; ?>
</body>
</html>