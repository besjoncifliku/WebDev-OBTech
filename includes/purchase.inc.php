<?php
session_start();

include_once('dbh.inc.php');


    if(isset($_POST['bli_kurs'])){
        $username = $_SESSION["user"];
        echo $username;
        $sql = "SELECT id FROM users where username='$username';";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
           $userid =  $row['id'];
        }

        $courseid = $_POST["kursi_blere"];

        //echo 'username '.$username.' course id '.$courseid;

        $sql_insert = "insert into user_course(userid,courseid) values($userid,$courseid);";
         $conn->query($sql_insert); 
        
         header("Location: ../userInterface.php");

    }


?>