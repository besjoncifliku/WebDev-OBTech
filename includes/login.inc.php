<?php
session_start();
include_once('../includes/dbh.inc.php');
// check if user exists or not
    $result=mysqli_query($conn,"select * from users 
        where username like '{$_POST['username']}' 
        and pw like '{$_POST['pass']}';");

    // create some cookies for username
    $_COOKIE['user'] = $_POST['username'];
    setcookie("user", $_POST['username'], time() + 28800, "/");

    if(mysqli_num_rows($result)==1){
        
        // if there is only one use with the following credentials fetch data
        $data=mysqli_fetch_assoc($result);
        // echo $data;
        // make seesion user that will be used in userInterface
        $_SESSION['user']=$data['username'];
        echo $_SESSION['user'];
        $_SESSION['id'] = $data['id'];
        $_SESSION['email']=$data['email'];
        $_SESSION['bdate']=$data['bdate'];
        $conn->close();

        if($data['username']=='admin' && $data['pw']=='admin'){
            // destroying cookises
            setcookie("user", $_POST['username'], time() - 28800, "/");
            header("Location: ../adminInterface.php?user=".$_SESSION['user']);
            //echo 'I am admin';
        }else{
            $timestamp = time();
            $out = $_SESSION['user']." logged in at: ".date("F d, Y h:i:s", $timestamp).PHP_EOL;
            // writting into files
            $file=fopen($_SESSION['user']." ".$_SESSION['surname'].".txt",'a');//Shkrimi ne file...
            fwrite($file,$out);
            fclose($file);

            //destroy all the cookies
            setcookie("user", $_POST['username'], time() - 28800, "/");
            setcookie("email", $clean['email'], time() - 28800, "/");
            setcookie("bdate", $clean['bdate'], time() - 28800, "/");

            if(!isset($_SESSION["logincomment"])){
                header("Location: ../userInterface.php?user=".$_SESSION['user']);  
            }else{
                if($_SESSION["logincomment"] ==1){
                    
                    $_SESSION["logincomment"] = 2;
                    header("location: viewMore.inc.php");
                }
            }
        }
        mysqli_close($conn);
    } else {
        echo "Server is not working properly!";
        header("Location: ../login.php?login=failed");
    }
//header("Location: ../login.php?login=failed");
