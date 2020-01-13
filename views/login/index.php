<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/reset.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/styles/myCss.css">

    <title>Blog</title>
</head>
<body>

    <?php require 'views/header.php'; ?>

    <form action="<?php echo constant('URL'); ?>login" method="post">
        <p>Email</p>
        <input type="email" name="email" required>
        <p>Password</p>
        <input type="password" name="password" required>
        <button type="submit">Submit</button>
    </form>
    
    <?php require 'views/footer.php'; ?>

</body>
</html>