<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact</title>
    <link rel="stylesheet" href="./CSS/stylesheet.css" />
  </head>
  <body>

    <?php

    // form variables
    $titleErr = $nameErr = $emailErr = $phonenumberErr = $communication_channelErr ="";
    $title=  $name = $email = $phonenumber = $communication_channel =$message = "";
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

      if(empty($_POST["communication_channel"])){
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
    
    // pre-modifying form data
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    // checking if all data is valid
    if($title !== "" && $name !=="" && $email !=="" && $phonenumber!== "" && $communication_channel !== "" && $titleErr === "" &&  $nameErr ==="" && $emailErr ==="" && $phonenumberErr === "" && $communication_channelErr ===""){
    $valid = true;
    }
    
    ?>



    <div class="wrapper">
      <h1>This is the contact page</h1>
      <ul class="menu">
        <li>
          <a href="http://localhost/educom-webshop-basis-1667987701/index.html"
            >HOME</a
          >
        </li>
        <li>
          <a href="http://localhost/educom-webshop-basis-1667987701/about.html"
            >ABOUT</a
          >
        </li>
        <li>
          <a
            href="http://localhost/educom-webshop-basis-1667987701/contact.php"
            >CONTACT</a
          >
        </li>
      </ul>
      <div class="content">
        <h2>Contact us:</h2>

      <?php if(!$valid): ?>

        <form class="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
          <label for="name">Name:</label>
          <select id="title" name="title">
            <option value="" selected>Title</option>
            <option value="mr" <?php if (isset($title) && $title=="mr") echo "selected";?>>Mr</option>
            <option value="mrs" <?php if (isset($title) && $title=="mrs") echo "selected";?>>Mrs</option>
          </select>
          <input class="form-field" type="text" id="name" name="name" value="<?php echo $name;?>"/>
          <span class="error">* <?php echo $titleErr;?></span>
          <span class="error"><?php echo $nameErr;?></span>

          <br />
          <label for="email">Email:</label>
          <input class="form-field" type="text" id="email" name="email" value="<?php echo $email;?>" />
          <span class="error">* <?php echo $emailErr;?></span>

          <br />
          <label for="phonenumber">Phone number:</label>
          <input
            class="form-field"
            type="text"
            id="phonenumber"
            name="phonenumber"
            value="<?php echo $phonenumber;?>"
          />
          <span class="error">* <?php echo $phonenumberErr;?></span>

          <br />
          <span>Preferred communication channel:</span>
          <input
            type="radio"
            id="email_channel"
            name="communication_channel"
            value="email"
            <?php if (isset($communication_channel) && $communication_channel=="email") echo "checked";?>
          />
          <label for="email_channel">Email</label>
          <input
            type="radio"
            id="phone_channel"
            name="communication_channel"
            value="phone"
            <?php if (isset($communication_channel) && $communication_channel=="phone") echo "checked";?>
          />
          <label for="phone_channel">Phone</label>
          <span class="error">* <?php echo $communication_channelErr;?></span>

          <br />
          <label for="message">Message:</label>
          <textarea class="form-field" name="message" id="message" ><?php echo $message;?></textarea>
          <br />
          <input type="submit" name="submit" value="Submit">
        </form>
        
        <?php else: ?>
          <p>Thank you for your message, <?php echo $name?> !</p>
        <?php endif ?>
      </div>
      <footer>
        <div>&copy; 2022 M. Sleeuwenhoek</div>
      </footer>
    </div>

    <?php
    
    ?>


  </body>
</html>
