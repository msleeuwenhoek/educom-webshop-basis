<?php



// form variables
$nameErr = $emailErr = $passwordErr = $confirm_passwordErr = "";
$name = $email = $password = $confirm_password = "";
$valid = false;

// validating form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
  }

  if (empty($_POST["confirm_password"])) {
    $confirm_passwordErr = "Please confirm your password";
  } else {
    $confirm_password = test_input($_POST["confirm_password"]);
    if ($_POST["confirm_password"] !== $_POST["password"]) {
      $confirm_passwordErr = "Passwords don't match";
    }
  }
}

// pre-modifying form data
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// checking if all data is valid
if ($name !== "" && $email !== "" && $password !== "" && $confirm_password !== "" && $nameErr === "" && $emailErr === "" && $passwordErr === "" && $confirm_passwordErr === "") {

  $users_file = fopen("./users/users.txt", "r");

  while (!feof($users_file)) {
    $user = fgets($users_file);
    if (stripos($user, $email) !== false) {
      $emailErr = "Email is already taken";
    }
  }
  fclose($users_file);
  if ($emailErr === "") {
    $valid = true;

    $users_file = fopen("./users/users.txt", "a");
    $new_user = "$email|$name|$password\n";
    fwrite($users_file, $new_user);
    fclose($users_file);
  }
}

?>


<?php if (!$valid) : ?>
  <div class="content">
    <h2>Register:</h2>
    <form class="register-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <label for="name">Name:</label>
      <input class="form-field" type="text" id="name" name="name" value="<?php echo $name; ?>" />
      <span class="error">* <?php echo $nameErr; ?></span>

      <br />
      <label for="email">Email:</label>
      <input class="form-field" type="text" id="email" name="email" value="<?php echo $email; ?>" />
      <span class="error">* <?php echo $emailErr; ?></span>

      <br />
      <label for="password">Password:</label>
      <input class="form-field" type="text" id="password" name="password" value="<?php echo $password; ?>" />
      <span class="error">* <?php echo $passwordErr; ?></span>

      <br />

      <label for="confirm_password">Confirm password:</label>
      <input class="form-field" type="text" id="confirm_password" name="confirm_password" value="<?php echo $confirm_password; ?>" />
      <span class="error">* <?php echo $confirm_passwordErr; ?></span>

      <br />

      <input type="hidden" name="page" value="register">
      <input type="submit" name="submit" value="Submit" id="submit">
    </form>
  </div>
<?php else : ?>
  <div class="content">
    <p>Thank you for registering, <?php echo $name ?>!</p>
  </div>
<?php endif ?>