<?php

session_start();
include_once '../includes/dbh.inc.php';

$sessionid = $_SESSION['id'];

$filename = '../uploads/profile'.$sessionid."*";
// glob -> function that searches for a specific file that we have partial name that we are looking for
$fileinfo = glob($filename);
// just for the first one
$fileExt = explode('.',$fileinfo[0]);
$fileactualExt = $fileExt[1]; //jpg not the name 

$file = 'uploads/profile'.$sessionid.'.'.$fileactualExt;

if(!unlink($file)){
    echo 'File is not deleted!';
}else {
    echo 'File is deleted!';
}

$sql = "UPDATE profile_image SET status = ? WHERE userid =".$sessionid.';';
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
                    header("Location: ../userInterface.php?delete=success");