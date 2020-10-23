<?php
    session_start();
    include_once 'dbh.inc.php';

    if(isset($_POST['submit'])){
        $course_name = $_POST['ctitle'];
        $course_description = $_POST['cdescription'];
        $course_price = (double)$_POST['cprice'];
        
        // Check if input is only digits
        $regex = '/^[0-9]+$/';
        $double = '/^-?(?:\d+|\d*\.\d+)$/';
            
        if(empty($course_price) || empty($course_name) || empty($course_description)){
            header("Location: ../adminInterface.php?upload=failed_You should complete all the fields");
        }else if(!preg_match($regex, $course_price) && !preg_match($regex, $course_price)){
            header("Location: ../adminInterface.php?upload=failed_Price should be digit");
        }else{            
            $sql = "INSERT INTO course(ctitle,cprice,cimage,cdescription,cvideo) VALUES (?, ?, ?, ?, ?);";
            // $stmt = mysqli_stmt_init($conn);
            // if(!mysqli_stmt_prepare($stmt,$sql)){
            //     echo "SQL error";
            // }else{
            //     $video = 'video.mp4';
            //     $image = 'images/courses_photo/default.png';
            //     mysqli_stmt_bind_param($stmt,"sssss",$course_name,$cours_price,$image,$course_description,$video);
            //     mysqli_stmt_execute($stmt);
            //     echo 'Successuful';
            //     //header("Location: ../adminInterface.php?course=success");
            // }


            // if ($conn->connect_error) {
            //     die("Connection failed: " . $conn->connect_error);
            // }
            
            $sql = "insert into course(ctitle,cprice,cimage,cdescription,cvideo) values 
            ('".$course_name."','".$course_price."','images/courses_photo/default.png','".$course_description."','video.mp4');";
            
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                header("Location: ../adminInterface.php?course=success");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            $conn->close();

            //Check connection
            // if ($conn->connect_error) {
            //     die("Connection failed: " . $conn->connect_error);
            // }

            // // prepare and bind
            // $stmt = $conn->prepare("INSERT INTO course(ctitle,cprice,cimage,cdescription,cvideo) VALUES (?, ?, ?, ?, ?)");
            // $stmt->bind_param("sssss", $course_name,$course_price,$image,$course_description,$video);
            // $stmt->execute();
            // echo $course_name." ".$course_price." ".$image." ".$course_description." ".$video."<br>";
            // $conn->close();
            // echo 'Successful';

        }echo "Failed";
        }
    
?>