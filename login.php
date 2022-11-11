<?php
$header = "<h1>This is the login page</h1>";

function showContent($data)
{
    echo ' <div class="content">
        <h2>Login:</h2>
        <form class="login-form" method="post" action="index.php">

            <label for="email">Email:</label>
            <input class="form-field" type="text" id="email" name="email" value="' . $data['email'] . '" />
            <span class="error">* ' . $data['emailErr'] . '</span>

            <br />
            <label for="password">Password:</label>
            <input class="form-field" type="text" id="password" name="password" value="' . $data['password'] . '" />
            <span class="error">* ' . $data['passwordErr'] . '</span>

            <br />

            <input type="hidden" name="page" value="login">
            <input type="submit" name="login" value="Login" id="login">
        </form>
    </div>';
}
