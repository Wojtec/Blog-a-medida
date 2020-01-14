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
<body class="back-color">

    <form class="front-color" action="<?php echo constant('URL'); ?>register/register" method="post">
        <div>
            <input type="text" placeholder="Username" name="username" required>
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" placeholder="Password" name="password" required>
            <input type="password" placeholder="Repeat password" name="password_confirmation" required>
            <button type="submit">Submit</button>
            <div>
                <?php 
                    echo '<p>You already have an account? <a href="' . constant("URL") . 'login">login</a></p>';
                ?>
            </div>
        </div>
        
    </form>
    

</body>
</html>