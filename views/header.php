<h1>Blogsite</h1>
<?php

if (isset($this->user))
{

    echo '
    <form action="' . constant("URL") . 'login/logout">
        <p>Logged in as ' . $this->user->user_name . '</p>
        <button type="submit">Logout</button>
    </form>
    ';
}

?>
<hr>
