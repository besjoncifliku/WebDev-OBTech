<?php
    include_once 'dbh.inc.php';
    if(isset($_POST['messageRead'])){
        $id = $_POST['msg-id'];
        echo $id;
        $sql = "UPDATE messages SET status = ? WHERE id =".$id.';';
        $stmt = mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt,$sql)){
            echo "SQL error";
        }else{
            $one = 1;
            mysqli_stmt_bind_param($stmt,"s",$one);
            mysqli_stmt_execute($stmt);
            echo 'Successuful';
            echo $id;
            //header("Location: ../adminInterface.php?read=successful");
        }
    }else{
        echo 'Something went wrong!';
    }
    
