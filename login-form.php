<?php



// form variables
$emailErr = $passwordErr = "";
$email = $password = "";
$valid = false;

// validating form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        $users_file = fopen("./users/users.txt", "r");

        while (!feof($users_file)) {
            $user = fgets($users_file);

            if (stripos($user, $email) !== false) {
                $emailErr = "";

                break;
            } else {
                $emailErr = "Email not found";
            }
        }



        fclose($users_file);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        $users_file = fopen("./users/users.txt", "r");

        while (!feof($users_file)) {
            $user = fgets($users_file);
            $user_data = explode("|", $user);

            if (stripos($user, $email) !== false && $password === trim($user_data[2])) {
                $passwordErr = "";
                break;
            } elseif (stripos($user, $email) !== false) {
                $passwordErr = "Password is incorrect";
            }
        }

        fclose($users_file);
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

// checking if all data matched database and was valid
if ($email !== "" && $password !== ""  && $emailErr === "" && $passwordErr === "") {
    $valid = true;
}

?>


<?php if (!$valid) : ?>
    <div class="content">
        <h2>Login:</h2>
        <form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <label for="email">Email:</label>
            <input class="form-field" type="text" id="email" name="email" value="<?php echo $email; ?>" />
            <span class="error">* <?php echo $emailErr; ?></span>

            <br />
            <label for="password">Password:</label>
            <input class="form-field" type="text" id="password" name="password" value="<?php echo $password; ?>" />
            <span class="error">* <?php echo $passwordErr; ?></span>

            <br />

            <input type="hidden" name="page" value="login">
            <input type="submit" name="login" value="Login" id="login">
        </form>
    </div>
<?php else : ?>
    <div class="content">
        <p>Thank you for loggin in!</p>
    </div>
<?php endif ?>