<?php
    session_start();

    if($_SESSION['id'] != "") {
        echo file_get_contents("body.html");
    } else {
        header("Location: login.php");
    }
    
?>