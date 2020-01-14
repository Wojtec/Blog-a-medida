<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/styles/reset.css">
    <link rel="stylesheet" href="public/styles/base-style.css">
    <link rel="stylesheet" href="public/styles/full-page-form.css">
    <title>Blog</title>
</head>
<body>

    <form action="<?php echo constant('URL'); ?>login/login" method="post" style="z-index: 10;">
        <div>
            <input type="email" name="email" placeholder="email" required>
            <input type="password" name="password" placeholder="password" required>
            <button type="submit">Submit</button>
            <div>
                <?php 
                    echo '<p class="link-text">You don\'t have an account? <a href="' . constant("URL") . 'register">register</a></p>';
                    echo '<p class="link-text">You don\'t want to login? <a href="' . constant("URL") . 'dashboard">continue anonymously</a></p>';
                ?>
            </div>
        </div>
    </form>
    
    

</body>
</html>