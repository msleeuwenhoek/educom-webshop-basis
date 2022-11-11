<?php
function validateRegistration()
{ // form variables
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



    // checking if all data is valid
    if ($name !== "" && $email !== "" && $password !== "" && $confirm_password !== "" && $nameErr === "" && $emailErr === "" && $passwordErr === "" && $confirm_passwordErr === "") {

        $users_file = fopen("./users/users.txt", "r");

        while (!feof($users_file)) {
            $user = fgets($users_file);
            if (stripos(
                $user,
                $email
            ) !== false) {
                $emailErr = "Email is already taken";
            }
        }
        fclose($users_file);
        if ($emailErr === "") {
            $valid = true;

            $users_file = fopen("./users/users.txt", "a");
            $new_user = "$email|$name|$password\n";
            fwrite(
                $users_file,
                $new_user
            );
            fclose($users_file);
        }
    }

    return array("name" => $name, "email" => $email, "password" => $password, "confirm_password" => $confirm_password, "nameErr" => $nameErr, "emailErr" => $emailErr, "passwordErr" => $passwordErr, "confirm_passwordErr" => $confirm_passwordErr, "valid" => $valid);
}

function validateLogin()
{ // form variables
    $emailErr = $passwordErr = "";
    $name = $email = $password = "";
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

    //set username
    $users_file = fopen("./users/users.txt", "r");
    while (!feof($users_file)) {
        $user = fgets($users_file);
        $user_data = explode("|", $user);

        if (stripos($user, $email) !== false) {
            $name = $user_data[1];
            break;
        }
    }
    fclose($users_file);

    // checking if all data matched database and was valid
    if ($email !== "" && $password !== ""  && $emailErr === "" && $passwordErr === "") {
        $valid = true;
    }
    return array("name" => $name, "email" => $email, "password" => $password, "emailErr" => $emailErr, "passwordErr" => $passwordErr,  "valid" => $valid);
}



function validateContact()
{
    // form variables
    $titleErr = $nameErr = $emailErr = $phonenumberErr = $communication_channelErr = "";
    $title =  $name = $email = $phonenumber = $communication_channel = $message = "";
    $valid = false;

    // validating form data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["title"])) {
            $titleErr = "Please indicate a title";
        } else {
            $title = test_input($_POST["title"]);
        }

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

        if (empty($_POST["phonenumber"])) {
            $phonenumberErr = "Phone number is required";
        } else {
            $phonenumber = test_input($_POST["phonenumber"]);
        }

        if (empty($_POST["communication_channel"])) {
            $communication_channelErr = "Please indicate your preferred communication channel";
        } else {
            $communication_channel = test_input($_POST["communication_channel"]);
        }

        if (empty($_POST["message"])) {
            $message = "";
        } else {
            $message = test_input($_POST["message"]);
        }
    }
    // checking if all data is valid
    if ($title !== "" && $name !== "" && $email !== "" && $phonenumber !== "" && $communication_channel !== "" && $titleErr === "" &&  $nameErr === "" && $emailErr === "" && $phonenumberErr === "" && $communication_channelErr === "") {
        $valid = true;
    }
    return array("title" => $title, "name" => $name, "email" => $email, "phonenumber" => $phonenumber, "communication_channel" => $communication_channel, "message" => $message, "titleErr" => $titleErr, "nameErr" => $nameErr, "emailErr" => $emailErr, "phonenumberErr" => $phonenumberErr, "communication_channelErr" => $communication_channelErr, "valid" => $valid);
}



function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
