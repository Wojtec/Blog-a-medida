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

    <form action="<?php echo constant('URL'); ?>register" method="post">
        <p>Username</p>
        <input type="text" name="username" required>
        <p>Email</p>
        <input type="email" name="email" required>
        <p>Password</p>
        <input type="password" name="password" required>
        <p>Repeat password</p>
        <input type="password" name="password_confirmation" required>
        <button type="submit">Submit</button>
    </form>
    
    <?php 
        echo '<p>You already have an account? <a href="' . constant("URL") . 'login">login</a></p>';
    ?>

</body>
</html>