<?php
    session_start();
    include "../includes/dbh.inc.php";

    $title = $_POST['title'];
    $desc = $_POST['des'];
    $username = $_SESSION['user'];
    if(empty($title) || empty($desc) || empty($username) ){
        header("Location: ../userInterface.php?post=failed");
    }else{
        $_SESSION['check'] = $desc;
    
        $sql = "insert into posts(name,title,post) values('$username','$title','$desc');";
    
         $result = $conn->query($sql);
    
        header("Location: home.php");
    }

?>