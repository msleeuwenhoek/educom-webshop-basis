<?php
session_start();


include 'validations.php';
include 'session_manager.php';

function getRequestedPage()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        return $_POST['page'];
    } else {
        return (isset($_GET["page"]) ? $_GET["page"] : 'home');
    }
}



function processRequest($page)
{
    switch ($page) {
        case 'contact':
            $data = validateContact();
            if ($data['valid'] === true) {
                $page = 'contact';
            }

            break;
        case 'register':
            $data = validateRegistration();
            if ($data['valid'] === true) {
                $page = 'login';
            }

            break;
        case 'login':
            $data = validateLogin();
            if ($data['valid'] === true) {
                logUserIn($data);
                $page = 'home';
            }
            break;

        case 'about':
            $page = 'about';
            break;
        case 'home':
            $page = 'home';
            break;
        case 'logout':
            logUserOut();
            $page = 'home';
            break;
    }

    $data['page'] = $page;
    return $data;
}
function showResponsePage($data)
{
    $current_page = $data['page'];
    include "$current_page.php";


    echo
    "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>$tab_title</title>
            <link rel='stylesheet' href='./CSS/index.css' />

        </head>
        <body>";



    echo "<div class='wrapper'>";
    echo $header;
    showMenu($data);

    showContent($data);


    include 'footer.html';
    echo "</div>";

    echo
    "</body>
        </html>";
}

$page = getRequestedPage();
$data = processRequest($page);
showResponsePage($data);


function showMenu($data)
{
    $pages = ['home', 'about', 'contact', 'register', 'login', 'logout'];
    echo '<ul class="menu">';

    foreach ($pages as $page) {
        if ($page === 'logout') {
            if (isset($_SESSION['username'])) {
                echo '<li>
    <a
      href="http://localhost/educom-webshop-basis-1667987701/index.php?page=' . $page . '"
      >' . strtoupper($page) . " " . strtoupper($_SESSION['username'])  . '</a
    >
  </li>';
            }
        } elseif ($page === 'login' || $page === 'register') {
            if (!isset($_SESSION['username'])) {
                echo '<li>
    <a
      href="http://localhost/educom-webshop-basis-1667987701/index.php?page=' . $page . '"
      >' . strtoupper($page) .  '</a
    >
  </li>';
            }
        } else {

            echo '<li>
    <a
      href="http://localhost/educom-webshop-basis-1667987701/index.php?page=' . $page . '"
      >' . strtoupper($page) . '</a
    >
  </li>';
        }
    };
    echo "</ul>";
}
