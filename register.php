<?php
$header = "<h1>This is the register page</h1>";
$tab_title = "Register";
$content = "";

function showContent($data)
{
    showRegisterForm($data);
}

function showRegisterForm($data)
{
    echo '

<div class="content">
  <h2>Register:</h2>
  <form class="register-form" method="post" action="index.php">
    <label for="name">Name:</label>
    <input class="form-field" type="text" id="name" name="name" value="' . $data["name"] . '" />
    <span class="error">* ' . $data["nameErr"] . '</span>

    <br />
    <label for="email">Email:</label>
    <input class="form-field" type="text" id="email" name="email" value="' . $data["email"] . '" />
    <span class="error">* ' . $data["emailErr"] . '</span>

    <br />
    <label for="password">Password:</label>
    <input class="form-field" type="text" id="password" name="password" value="' . $data["password"] . '" />
    <span class="error">* ' . $data["passwordErr"] . '</span>

    <br />

    <label for="confirm_password">Confirm password:</label>
    <input class="form-field" type="text" id="confirm_password" name="confirm_password" value="' . $data["confirm_password"] . '" />
    <span class="error">* ' . $data["confirm_passwordErr"] . '</span>

    <br />

    <input type="hidden" name="page" value="register">
    <input type="submit" name="submit" value="Submit" id="submit">
  </form>
</div>';
}
