<?php
    $username="videotecha";
    $password="";
    $address="localhost";
    $db_name="my_videotecha";
    $connex_db= new mysqli($address,$username,$password,$db_name);
    if (!$connex_db)
        die ("Impossibile connettersi: ". $connex_db->connect_error);
    echo "<script src='src/jquery/jquery.js'></script>";
    echo "<link rel='stylesheet' href ='src/css/style.css'>";
?>