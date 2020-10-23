<?php
    session_start();

    session_unset();
    session_destroy();

    //echo $_SESSION["logincomment"];
    header("location: home.php?session=destroyed");

?>