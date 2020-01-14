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
   
    <form action="<?php echo constant('URL'); ?>controlpanel" method="post">
             <label for="start-date">Start date:</label>
            <input type="date" id="start-date" name="start-date">
            <label for="new-catgory">Category</label>
            <input type="text" name="new-category">
            <label for="new-catgory">Tags</label>
            <input type="text" name="tags">
            <label for="new-title">Title</label>
            <input type="text" name="new-title">
            <textarea name="post-message" rows="10" cols="100">Text area.</textarea>    
            <input type="submit" name="subit-new-post">
    </form>
    <?php require 'views/footer.php'; ?>
</body>
</html>