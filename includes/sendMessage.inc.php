<?php
include_once('dbh.inc.php');

    $email = $_POST['email'];
    $name = $_POST['name'];
    $msg = $_POST['message'];
    echo $name;
    if (empty($name) || empty($email)){
            //header('Location: ../login.php?signup=empty');
        echo 'Name is empty or email is empty!';
        }else{
            if(!preg_match("/^([a-zA-Z' ]+)$/",$name)){
        //     header('Location: ../login.php?signup=char');
        //     exit();
            echo 'Name should not contain numbers';
            }else{
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                header('Location: ../about.php?email=invalidemail');
            }
            else {
                $sql = "INSERT INTO messages(name,email,msg,status) VALUES 
                (?, ?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    echo "SQL error";
                }else{
                    echo 'Inserting message';
                    // status 0 means it has not been read yet
                    $status = 0;
                    mysqli_stmt_bind_param($stmt,"ssss", $name, $email ,$msg, $status);
                    mysqli_stmt_execute($stmt);
                    echo 'Successful';
                    header('Location: ../about.php?message=sent');
                }
            }
        }
    }

?>
