<?php

    include "conn.php";

    $uname = $_POST['username'];
    $password = $_POST['password'];


    $sql = "insert into users(username,passs) values('$uname','$password');";

    $result = $conn->query($sql);

    header("Location: index.php");


?>