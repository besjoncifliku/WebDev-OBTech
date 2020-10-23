<?php

    session_start();
    include "../includes/dbh.inc.php";
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
    <link type="text/css" rel ="stylesheet" href = "css/blog.css"/>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/navbar.css">
    <script src="https://kit.fontawesome.com/8e71d0b45b.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js">
    </script>

    <script src="js/jquery.min.js">
    
    </script>

</head>

<body>
<header class="header">
        <nav class="nav">
            <ul>
                <?php 
                if(isset($_SESSION["user"])){
                    echo ' <li class="submenu"  onmouseout="hamburgerOut();">
                    <a href="../userInterface.php" id="submenu">
                        <i class="fas fa-bars"></i></a></li>';
                }else{
                    echo ' <li class="submenu"  onmouseout="hamburgerOut();">
                    <a href="#" id="submenu">
                        <i class="fas fa-bars"></i></a></li>';
                }
                ?>
                <li><a href="../index.html">Home</a></li>
                <li><a href="#"  class="active">Blog</a></li>
                <li><a href="../academy.php">Academy</a></li>
                <li><a href="#">Home</a></li>
                <li onmouseout="logoWhite();"><a href="#" id="logoHover" onmouseover="logoBlack();"><img src="../images/logo_2.png" class = "logo" alt="Logo"></a></li>
                <li><a href="#">Services</a></li>
                <li><a href="../shop.php">Shop</a></li>
                <li><a href="../about.php">About Us</a></li>
                <?php 
                    if(isset($_SESSION["user"])){
                        echo '<li class="login"><a href="logout.php"><span><i class="fas fa-sign-in-alt"></i></span>   Log Out</a></li>';
                    }else{
                        echo '<li class="login"><a href="../login.php"><span><i class="fas fa-sign-in-alt"></i></span>   Log In</a></li>';
                    }
                ?>
            </ul>
            <script>
                function hamburgerIn(){
                    document.getElementById('submenu').innerHTML = '<i class="fas fa-hamburger submenu"></i>'
                }

                function hamburgerOut(){
                    document.getElementById('submenu').innerHTML = '<i class="fas fa-bars submenu"></i>'

                }

                function logoWhite(){
                    document.getElementById('logoHover').innerHTML = '<img src="../images/logo_2.png" class = "logo" alt="Logo">';
                }

                function logoBlack(){
                    document.getElementById('logoHover').innerHTML = '<img src="../images/logo_2Black.png" class = "logo" alt="Logo">';
                }
            </script>
        </nav>
    </header>
    <div class="container-fluid">
        <!-- <div class="row">

            <div id='pro3' class='col-xs-8'><a href='logout.php'>Log out</a></div> 
               

        </div> -->

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

            <div id="pro2" class="col-xs-2">

                 <?php
                //  if(isset($_POST['submit'])){

                //      $name = $_FILES['myfile']['name'];
                    
                //      $tmp_name = $_FILES['myfile']['tmp_name'];

                //      if($name){
                //         $location = "image/".$name;
                //          move_uploaded_file($tmp_name,$location);

                //          $sqlupdate = "UPDATE users SET image = '$location' WHERE username='$username';";
                //          $conn->query($sqlupdate);
                //          mysqli_query($conn,"UPDATE users SET image = '$location' WHERE username='$username';");

                            
                //     }

                //  }
                


                // echo "<br>";
                // echo "<br>";
                // echo "<br>";
                // echo "
                //     <form action='home.php' method='post' enctype='multipart/form-data'>
                //         <input type='file' name='myfile'>
                //         <input type='submit' name='submit' value='Upload Photo'>
                    
                    
                //     </form>";
                //     echo "<br>";
                //     echo "<br>";
            
            
                ?> 


            </div>
            
            
            <!-- <?php 
            // *********** Pjesa qe krijohet nje postim , supozohet te vendoset tek user interace

            // if(isset($_SESSION["user"]) && isset($_SESSION["logincomment"])){

                ?>
                
               <div id="post" class=''>
                       
                    <div class="post-section">
                        <form action='post.php' method='post'>
                           <div><input type='text' name='title' placeholder ='Title:'></div>
                           <!-- <input type="text" name='des' placeholder="describe.."> -->
                           <!-- <div style='margin-top:10px; margin-bottom:10px;'><textarea rows="4" cols="100" name='des' placeholder='describe..'></textarea></div>
                           <div><input type='submit' onclick="" value='post' name='share'></div>
                       
                       </form>
                       
                    </div>
           
               </div>
           <?php //} ************************** ?> -->



            <hr>
            <div id="body">
                    <div>
                            <?php 
                           
                            $sql = "SELECT * FROM posts ORDER BY id desc";
                            $result = $conn->query($sql);
                            
                            if($result->num_rows > 0){

                                //iterimi i te gjitha posteve 
                                while($row = $result->fetch_assoc()){
                                    echo "<div  class='postimi' onclick='fireViewMore();'><br>"."Title:".$row['title']."<br>".$row['post']."<br>"."Posted by"."<br>
                                    ".$row['name']." at".$row['time']." "."<br>";
                                    ?>
                                    <form action="../includes/viewMore.inc.php" method="post">
                                            <input class='view_button'type="submit" value="View more" id='viewMore' name="viewMore"> 
                                            <input type="hidden" value="<?php echo $row['id'] ?>" name="posti">
                                    </form>
                                    <script>
                                        functon fireViewMore(){
                                            document.getElementById('viewMore').click();
                                        }
                                    </script>
                                        <?php
                                   echo "</div>";

                                    
                                    
                                    //  $post_id = $row['id'];
                                    // $sql_post_comments = "SELECT * FROM  users u JOIN comments co on u.id = co.usid JOIN posts p on co.pid= p.id where p.id = '$post_id';";
                                    // $comments_made = $conn->query($sql_post_comments);
                                        //iterimi i commenteve tek nje post
                                        // while ($row_comments = $comments_made->fetch_assoc()) {
                                                
                                        ?>
                                        

                                        <!-- <div>
                                            <?php echo $row_comments["username"]." commented at ".$row_comments["time"]."<br>".$row_comments["content"];?>
                                        </div> -->
                                        
                                       <?php 
                                            
                                             } 
                                       ?> 
<!-- 
                                    <button onclick ="myFunction();"  name="addcomm" id="add_comm">Add a comment</button>
                                    <button onclick =""  name='logincomment' id="log_in">Login</button>
                                    <form action="comment.php" method="post">W
                                        <div style='margin-top:10px; margin-bottom:10px; disllay:none' id="comment"><textarea rows="4" cols="100" name='komenti' placeholder='Comment here..'></textarea></div>
                                         <input type='submit' style="dislay:none" id="submit_comment" value='post' name='comment'> 
                                         <input type="hidden" id="postid" name="custId" value="<?php echo $row['id'] ?>">
                                    </form> -->
                                   
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