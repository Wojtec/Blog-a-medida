<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/reset.css">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/styles/myCss.css">

    <title>Blog</title>
</head>
<body>
<?php require 'views/header.php'; ?>

    </section>

    <section>
    <!-- Modal -->
    <div id="login-modal" class="login-modal">
        <!-- Modal container -->
        <form class="modal-cont" action="">
            <!-- Login img -->
            <div class="logo-login">
               <a href="<?php echo constant('URL');?>"> <span id="close" class="close">&times;</span></a>
                <img src="assets/login.jpg" alt="logo-login" width="150">
            </div>
            <!-- Login container -->
            <div class="log-container">
                <label for="userName">Username</label>
                <input type="text" placeholder="Your Login" name="userName" required>
               
                <label for="password">Password</label>
                <input type="text" placeholder="Your Password" name="password" required>
            </div>
            <!-- Checkbox for Remember me -->
            <label>
                <input type="checkbox" checked="checked" name="remeber">Remember me
            </label>
            <!-- Login btn's -->
            <div class="login-btns">
                <button type="submit">Login</button>
                <button onclick="location.href='<?php echo constant('URL');?>register'" id="register" type="button">Register</button>
            </div>
            <div class="log-container">
                 <span class="forgot-psw"><a href="#">Don't remember Password ?</a></span>               
            </div>
        </form>
    </div>
    </section>
    <?php require 'views/footer.php'; ?>

    <script src="Other/login.js"></script>

</body>
</html>