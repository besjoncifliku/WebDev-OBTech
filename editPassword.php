<?php
    include_once('includes/dbh.inc.php');
    session_start();
    if (count($_POST) > 0) {
        $result = mysqli_query($conn, "SELECT *from users WHERE id='" . $_SESSION["id"] . "'");
        $row = mysqli_fetch_array($result);
       if ($_POST["oldPassword"] == $row["pw"]) {
            mysqli_query($conn, "UPDATE users set pw='" . $_POST["newPassword"] . "' WHERE id='" . $_SESSION["id"] . "'");
            $message = "Password Changed";
            echo $message;
            header("Location: ./userInterface.php?passowrd=successful");
        } else
            $message = "Your old password is not correct";
            echo $message;
    }