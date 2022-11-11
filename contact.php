<?php
$tab_title = "Contact";
$header = "<h1>This is the contact page</h1>";
$content = "";



function showContactForm($data)
{
    echo
    '<div class="content">
    <h2>Contact us:</h2>
    <form class="contact-form" method="post" action="index.php">
      <label for="name">Name:</label>
      <select id="title" name="title">
        <option value="" selected>Title</option>
        <option value="mr"';
    if (isset($data['title']) && $data['title']  == "mr") echo "selected";
    echo '>Mr</option>
        <option value="mrs"';
    if (isset($data['title']) && $data['title'] == "mrs") echo "selected";
    echo '>Mrs</option>
      </select>
      <input class="form-field" type="text" id="name" name="name" value="' . $data['name'] . '" />
      <span class="error">* ' . $data['titleErr'] . '</span>
      <span class="error"> ' . $data['nameErr'] . '</span>

      <br />
      <label for="email">Email:</label>
      <input class="form-field" type="text" id="email" name="email" value="' . $data['email'] . '" />
      <span class="error">* ' . $data['emailErr'] . '</span>

      <br />
      <label for="phonenumber">Phone number:</label>
      <input class="form-field" type="text" id="phonenumber" name="phonenumber" value="' . $data['phonenumber'] . '" />
      <span class="error">* ' . $data['phonenumberErr'] . '</span>

      <br />
      <span>Preferred communication channel:</span>
      <input type="radio" id="email_channel" name="communication_channel" value="email"';
    if (isset($data['communication_channel']) && $data['communication_channel'] == "email") echo "checked";
    echo ' />
      <label for="email_channel">Email</label>
      <input type="radio" id="phone_channel" name="communication_channel" value="phone"';
    if (isset($data['communication_channel']) && $data['communication_channel'] == "phone") echo "checked";
    echo ' />
      <label for="phone_channel">Phone</label>
      <span class="error">* ' . $data['communication_channelErr'] . '</span>

      <br />
      <label for="message">Message:</label>
      <textarea class="form-field" name="message" id="message">' . $data['message'] . '</textarea>
      <br />
      <input type="hidden" name="page" value="contact">
      <input type="submit" name="submit" value="Submit" id="submit">
    </form>
  </div>
';
}

function showThankyouPage($data)
{
    echo '<div class="content">
    <p>Thank you for your message, ' . $data['name'] . '!</p>
  </div>';
}

function showContent($data)
{
    if ($data['valid'] === true) {
        showThankyouPage($data);
    } else {
        showContactForm($data);
    }
}
