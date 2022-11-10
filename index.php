<?php
    function getRequestedPage(){
       return ($_GET['page']);
    }
    
    function showResponsePage($Page){
        include "$Page.php";

        echo 
        "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>$tab_title</title>
            <link rel='stylesheet' href='./CSS/stylesheet.css' />

        </head>
        <body>";

        echo "<div class='wrapper'>";
        echo $header;
        include 'menu.html';
        
        echo $content;
        if($Page === "contact"){include 'contact-form.php';}

        include 'footer.html';
        echo "</div>";

        echo 
        "</body>
        </html>";
    }

    $page = getRequestedPage();
        showResponsePage($page);

?>




