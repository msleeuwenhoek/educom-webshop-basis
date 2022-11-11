<?php
session_start();

include 'validations.php';
include 'session_manager.php';

// Determine the requested page
function getRequestedPage()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        return $_POST['page'];
    } else {
        return (isset($_GET["page"]) ? $_GET["page"] : 'home');
    }
}

// Set page & re-route if neccessary
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
        default:
            $page = 'unknown';
    }
    $data['page'] = $page;
    return $data;
}

// Show page content depending on requested page
function showResponsePage($data)
{
    $current_page = $data['page'];
    if ($current_page !== 'unknown') {
        include "$current_page.php";
    }
    showDocumentStart($current_page);
    if ($current_page !== 'unknown') {
        echo $header;
    }
    showMenu($data);
    if ($current_page !== 'unknown') {
        showContent($data);
    } else {
        echo "Sorry, we couldn't find the page you were looking for";
    }
    showFooter();
    showDocumentEnd();
}

// Main
$page = getRequestedPage();
$data = processRequest($page);
showResponsePage($data);


// Show default page content

function showDocumentStart($tab_title)
{
    echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>$tab_title</title>
            <link rel='stylesheet' href='./CSS/index.css' />
        </head>
        <body>
        <div class='wrapper'>";
}

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
                >' . strtoupper($page) . " " . strtoupper($_SESSION['username'])  . '</a>                </li>';
            }
        } elseif ($page === 'login' || $page === 'register') {
            if (!isset($_SESSION['username'])) {
                echo '<li>
                <a
                href="http://localhost/educom-webshop-basis-1667987701/index.php?page=' . $page . '"
                >' . strtoupper($page) .  '</a>
                </li>';
            }
        } else {
            echo '<li>
            <a
            href="http://localhost/educom-webshop-basis-1667987701/index.php?page=' . $page . '"
            >' . strtoupper($page) . '</a>
             </li>';
        }
    };
    echo "</ul>";
}

function showFooter()
{
    echo '<footer>
    <div>&copy; 2022 M. Sleeuwenhoek</div>
    </footer>';
}

function showDocumentEnd()
{
    echo "</div>
    </body>
    </html>";
}
