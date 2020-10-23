<?php

    session_start();

    include "conn.php";

    $uname = $_POST['uname'];
    $password = $_POST['pass'];


    $sql = "SELECT * from users where username='$uname' AND passs='$password';";

    $result = $conn->query($sql);

    $_SESSION['name'] = $_POST['uname'];
    
    header('Location: home.php');






?>