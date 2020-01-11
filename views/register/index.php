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
    
    <h1>register!</h1>
              <!-- Register -->
              <section>
        <!-- Modal -->
        <div id="register-modal" class="login-modal">
            <!-- Modal container -->
            <form class="modal-cont" action="">
                <!-- register img -->
                <div class="logo-login">
                <a href="<?php echo constant('URL');?>"><span id="close-reg" class="close">&times;</span></a>
                    <img src="assets/login.jpg" alt="logo-login" width="150">
                </div>
                <!-- input container -->
                <div class="log-container">
                    <div>  <label for="userName">Username</label>
                        <input type="text" placeholder="Your Login" name="userName" required>
                    </div>
                   <div>
                    <label for="emailName">E-mail</label>
                    <input type="text" placeholder="Your E-mail" name="emailName" required>
                   </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="text" placeholder="Your Password" name="password" required>
                    </div>
                   <div>
                    <label for="sec-password">Confirm Password</label>
                    <input type="text" placeholder="Your Password" name="sec-password" required>
                   </div>
                   
                </div>                   
                <!-- Register btn's -->
                <div class="login-btns">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <?php require 'views/footer.php'; ?>
    <script src="Other/login.js"></script>

</body>
</html>