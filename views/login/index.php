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

    <form action="<?php echo constant('URL'); ?>login" method="post">
        <p>Email</p>
        <input type="email" name="email" required>
        <p>Password</p>
        <input type="password" name="password" required>
        <button type="submit">Submit</button>
    </form>
    
    <?php 
        echo '<p>You don\'t have an account? <a href="' . constant("URL") . 'register">register</a></p>';
        echo '<p>You don\'t want to login? <a href="' . constant("URL") . 'dashboard">continue anonymously</a></p>';
    ?>

</body>
</html>