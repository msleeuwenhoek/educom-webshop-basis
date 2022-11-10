<?php
    function getRequestedPage(){
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            return $_POST['page'];
        } else{
       return (isset($_GET["page"]) ? $_GET["page"] : 'home');
    }}
    
    function showResponsePage($page){
        include "$page.php";

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
        include 'menu.html';
        
        echo $content;
        if($page === "contact"){include 'contact-form.php';}
        if($page === "register"){include 'register-form.php';}

        include 'footer.html';
        echo "</div>";

        echo 
        "</body>
        </html>";
    }

    $page = getRequestedPage();
    
    showResponsePage($page);

?>





