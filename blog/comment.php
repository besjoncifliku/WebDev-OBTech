<?php 
    session_start();
    
    include_once "../includes/dbh.inc.php";

    if(isset($_POST["comment"]) || isset($_POST["shtokoment"])){

        if(empty($_POST["newcomment"])){
            header("Location: ../includes/viewMore.inc.php");
        }
        else{
            $username = $_SESSION["user"];

        //Marrja e id se userit
        $sql = "SELECT id FROM users where username='$username';";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $userid =  $row['id'];
        }
            if(isset($_POST["shtokoment"])){
               
                $content = $_POST["newcomment"];
                $post_id = $_SESSION["post_id"];
            }
            else{
                $post_id = $_POST["custId"];
                $content = $_POST["komenti"];
            }
        

        $sql_insert = "insert into comments(usid,pid,content) values('$userid','$post_id','$content');";
        $conn->query($sql_insert); 
        echo "<script>alert('Your comment was added successfully');</script>";
        header("Location: ../includes/viewMore.inc.php");
        //header("Location: home.php");
        //$sql_post_comments = "SELECT * FROM  users u JOIN comments co on u.id = co.commid JOIN posts p on co.commid= p.id where p.id = '$post_id';";
        //$comments_made = $conn->query($sql_user_course);


    }

        }
        
    // else if(isset($_POST["shtokoment"])) {

    // }












?>