<!-- error handler : limit for file size/input type -->
<?php
    session_start();
    include_once '../includes/dbh.inc.php';
    $id = $_SESSION['id'];

    if(isset($_POST['submit'])){
        // upload the file $_FILES = get information from file that you want to input
        $file = $_FILES['file'];
        // we could aslo have set it equal to $file['name']
        //instead. $fileName = $file['name']
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.',$fileName);//to separate the file name form the extension .jpg for ex
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg','jpeg','png','svg','pdf');

        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 1000000){
                    // $fileNameNew = uniqid('', true).'.'.$fileActualExt;
                    $fileNameNew = "profile".$id.'.'.$fileActualExt;
                    $fileDestination = '../uploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    
                    $sql = "UPDATE profile_image SET status = ? WHERE userid =".$id.';';
                    //$result = mysqli_query($conn,$sql);

                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        echo "SQL error";
                    }else{
                        $one = 1;
                        mysqli_stmt_bind_param($stmt,"s",$one);
                        mysqli_stmt_execute($stmt);
                        //echo 'Successuful';
                    }
                    header("Location: ../userInterface.php?upload=success");
                }else {
                    echo 'Your file is too big!';
                }
            }else{
                echo 'There was an error uploading your file!';
            }
        }else{
            echo 'You cannot upload files of this type!';
        }
    }
?>