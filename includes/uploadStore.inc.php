<!-- error handler : limit for file size/input type -->
<?php
    session_start();
    include_once 'dbh.inc.php';

    // find how many products are already stored there
    $counter = 0;
    $sql_product = 'Select count(product_id) as cnt from store;';
    $result = mysqli_query($conn,$sql_product);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $counter = $row['cnt'];
    }

    $id = $counter+1;

    if(isset($_POST['submit'])){
        $prod_name = $_POST['prod_name'];
        $prod_description = $_POST['prod_descr'];
        $prod_price = (double)$_POST['prod_price'];
        $prod_quantity = (int)$_POST['prod_quantity'];

        // Check if input is only digits
        $regex = '/^[0-9]+$/';
        $double = '/^-?(?:\d+|\d*\.\d+)$/';
            
        if(empty($prod_price) || empty($prod_name) || empty($prod_description) || empty($prod_quantity)){
            header("Location: ../adminInterface.php?upload=failed_You should complete all the fields");
        }else if(!preg_match($double, $prod_price)){
            header("Location: ../adminInterface.php?upload=failed_Price should be digit");
        }else if(!preg_match($regex, $prod_quantity)){
            header("Location: ../adminInterface.php?upload=failed_Qunatity is not integer");
        }else{
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
                        $fileNameNew = "product".$id.'.'.$fileActualExt;
                        $fileDestination = '../images/store/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        
                        $sql = "INSERT INTO store(product_name,product_descr,product_price_was,product_price_is,quantity) VALUES (?, ?, ?, ?, ?);";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$sql)){
                            echo "SQL error";
                        }else{
                            $prod_price_was = $prod_price;
                            mysqli_stmt_bind_param($stmt,"sssss",$prod_name,$prod_description,$prod_price_was, $prod_price,$prod_quantity);
                            mysqli_stmt_execute($stmt);
                            echo 'Successuful';
                        }
                        header("Location: ../adminInterface.php?upload=success");
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
    }
?>