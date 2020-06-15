<div class="header">

    <?php
        echo '
        <div class="title vertical-centered-text">
            <a href="' . constant("URL") . 'dashboard"><h1>Blogsite</h1></a>
        </div>
        ';

        echo '<div class="vertical-centered-text">';
        if (isset($this->user))
        {
            echo '<p>Logged in as ' . $this->user->user_name . '</p>';
            echo '<a href="' . constant("URL") . 'controlpanel"><p>Control Panel</p></a>';
            echo '<a href="' . constant("URL") . 'login/logout"><p>Logout</p></a>';
        } else {
            echo '<a href="' . constant("URL") . 'login"><p>Login</p></a>';
        }
        echo '</div>';
    ?>

</div>

<hr>

