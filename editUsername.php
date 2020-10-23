<?php
    include_once('includes/dbh.inc.php');
    session_start();
    if (count($_POST) > 0) {
        $result = mysqli_query($conn, "SELECT *from users WHERE id='" . $_SESSION["id"] . "'");
        $row = mysqli_fetch_array($result);
       if ($_POST["oldUsername"] == $row["username"]) {
            mysqli_query($conn, "UPDATE users set username='" . $_POST["newUsername"] . "' WHERE id='" . $_SESSION["id"] . "'");
            $message = "Username Changed";
            echo $message;
            $_SESSION["user"] = $_POST["newUsername"];
            header("Location: ./userInterface.php?username=successful");
        } else
            $message = "Your old username is not correct";
            echo $message;
    }