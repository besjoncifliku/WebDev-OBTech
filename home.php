<?php
    session_start();
    include "includes/dbh.inc.php";
    if(isset($_SESSION["user"]) && !isset($_SESSION["logincomment"])){
        $username = $_SESSION['user'];
    }

    if(isset($_POST["logincomment"])){
        header("Location: ../login.php");
    }
   
    if(isset($_SESSION["logincomment"])){
        if($_SESSION["logincomment"]==2){
            echo "<script>
            document.getElementById('submit_comment').style.display = 'block';
            document.getElementById('comment').style.display = 'block';
        </script>";
        }
    }
    if(isset($_POST["comment"])){
        echo "<script>
        document.getElementById('submit_comment').style.display = 'none';
        document.getElementById('comment').style.display = 'none';
    </script>";
    }
    //$post = $_SESSION['pershkrim'];
?>

<html>
<head>
    <link type="text/css" rel ="stylesheet" href = "css/bootstrap.css"/>
    <script src="js/bootstrap.js">
    </script>
    <script src="js/jquery.min.js">
    </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-6"><h2>My Blog</h2></g2></div>
            <div id='pro3' class='col-xs-8'><a href='logout.php'>Log out</a></div> 
        </div>
        <br>
        <div id="profile" class="">
            <div class="">
                <?php
                       if(isset($_SESSION["user"]) && !isset($_SESSION["logincomment"])) {
                            $sql = "SELECT * from users where username='$username';";

                            $result = $conn->query($sql);

                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    // $location = $row['image'];
                                    ?>
                                    <div style='margin-left:5%; margin-bottom:20px;'><?php echo $username; ?></div>
                                    <?php
                                   // echo "<img id='img' style='width:160px; height:160px; border-radius:100px;' alt='Please upload a photo' src='$location'>";
                                }
                            }
                            else {
                                echo "0 image results";
                            }
                       }     
                ?>
            </div> 
            <?php 
            // if(isset($_SESSION["user"]) && !isset($_SESSION["logincomment"])){

             ?>
             
            <div id="post" class=''>
                    
                 <div class="post-section">
                     <form action='post.php' method='post'>
                        <div><input type='text' name='title' placeholder ='Title:'></div>
                        <!-- <input type="text" name='des' placeholder="describe.."> -->
                        <div style='margin-top:10px; margin-bottom:10px;'><textarea rows="4" cols="100" name='des' placeholder='describe..'></textarea></div>
                        <div><input type='submit' onclick="" value='post' name='share'></div>
                    
                    </form>
                    
                 </div>
        
            </div>
        <?php 
            // } 
        ?>
            <hr>
            <div id="body">
                    <div>
                            <?php                  
                            $sql = "SELECT * FROM posts ORDER BY id desc";
                            $result = $conn->query($sql);
                            ?>
                            <?php
                            if($result->num_rows > 0){

                                //iterimi i te gjitha posteve 
                                while($row = $result->fetch_assoc()){
                                    echo "<div style='margin-left:20%';><br>"."Title:".$row['title']."<br>".$row['post']."<br>"."Posted by"."<br>
                                    ".$row['name']." at".$row['time']." "."<br></div>";
                                    
                                     $post_id = $row['id'];
                                    $sql_post_comments = "SELECT * FROM  users u JOIN comments co on u.id = co.usid JOIN posts p on co.pid= p.id where p.id = '$post_id';";
                                    $comments_made = $conn->query($sql_post_comments);
                                        //iterimi i commenteve tek nje post
                                        while ($row_comments = $comments_made->fetch_assoc()) {
                                                
                                        ?>
                                        <div>
                                            <?php echo $row_comments["username"]." commented at ".$row_comments["time"]."<br>".$row_comments["content"];?>
                                        </div>
                                        <?php  } ?>
                                    <button onclick ="myFunction();"  name="addcomm" id="add_comm">Add a comment</button>
                                    <button onclick =""  name='logincomment' id="log_in">Login</button>
                                    <form action="comment.php" method="post">W
                                        <div style='margin-top:10px; margin-bottom:10px; dislay:none' id="comment"><textarea rows="4" cols="100" name='komenti' placeholder='Comment here..'></textarea></div>
                                         <input type='submit' style="dislay:none" id="submit_comment" value='post' name='comment'> 
                                         <input type="hidden" id="postid" name="custId" value="<?php echo $row['id'] ?>">
                                    </form>
                                   <hr>
                                   <?php 
                                }
                                ?>
                                <?php
                            }
                            else{
                                echo "0 results";
                            }
                            if(isset($_POST['share'])){
                                 echo $_SESSION['check'];
                                }
                               
                            $conn->close();
                        ?>
                    </div>
            </div>
        </div>
    </div>
    <script>
    function myFunction() {
        var r = confirm("Please type Ok if you want to continue to login and comment  , else click no");
        if (r == true) {
            <?php $_SESSION["logincomment"]=1; ?>
            window.location.href = "../login.php";
        } else {   
        }    
    }
  </script>                        
</body>
</html>