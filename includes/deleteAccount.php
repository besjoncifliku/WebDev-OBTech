<?php
    session_start();
    include_once('dbh.inc.php');
    $user_id = $_POST['user-id'];
    if(isset($_POST['deleteAccount'])){
       

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // sql to delete a record
    $update2 = "DELETE FROM users
                WHERE id=".$user_id.";";
    $update1 = "DELETE FROM profile_image
    WHERE userid=".$user_id.";";
    if($conn->query($update1) === TRUE){
        if ($conn->query($update2) === TRUE) {
            echo "Record deleted successfully";
            $sessionid = $user_id;

            $filename = '../uploads/profile'.$user_id."*";
            // glob -> function that searches for a specific file that we have partial name that we are looking for
            $fileinfo = glob($filename);
            // just for the first one
            $fileExt = explode('.',$fileinfo[0]);
            $fileactualExt = $fileExt[1]; //jpg not the name 

            $file = 'uploads/profile'.$user_id.'.'.$fileactualExt;

            if(!unlink($file)){
                echo 'File is not deleted!';
            }else {
                echo 'File is deleted!';
            }

            $sql = "UPDATE profile_image SET status = ? WHERE userid =".$user_id.';';
                                //$result = mysqli_query($conn,$sql);

            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                echo "SQL error";
            }else{
                $zero = 0;
                mysqli_stmt_bind_param($stmt,"s",$zero);
                mysqli_stmt_execute($stmt);
                echo 'Successuful';
            }
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
        mysqli_close($conn);
        header('Location: dlelete.inc.php?delete=success');
        //echo 'success';
    }else{
        header('Location: ../adminInterface.php?delete=failed');
    }