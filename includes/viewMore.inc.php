<?php
    include "dbh.inc.php";
    session_start();

?>
<htmL>
    <head>
    <link rel="stylesheet" href="../blog/css/blog.css"> 
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/navbar.css">
    <script src="https://kit.fontawesome.com/8e71d0b45b.js" crossorigin="anonymous"></script>
    </head>
    
    <body style='background-color:lightblue;'>
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
                <li><a href="index.html">Home</a></li>
                <li><a href="../blog/blog.php"  class="active">Blog</a></li>
                <li><a href="../academy.php">Academy</a></li>
                <li><a href="#">Home</a></li>
                <li onmouseout="logoWhite();"><a href="#" id="logoHover" onmouseover="logoBlack();"><img src="../images/logo_2.png" class = "logo" alt="Logo"></a></li>
                <li><a href="#">Services</a></li>
                <li><a href="../shop.php">Shop</a></li>
                <li><a href="../about.php">About Us</a></li>
                <?php 
                    if(isset($_SESSION["user"])){
                        echo '<li class="login"><a href="../blog/logout.php"><span><i class="fas fa-sign-in-alt"></i></span>   Log Out</a></li>';
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

<?php
        
    ///nqs vjen nga faqja kryesore e blogut , dhe useri ka klikuar view more per nje post

    // if(isset($_POST["viewMore"]) )
    {
        
      if(isset($_POST["viewMore"])){ 
        $_SESSION["post_id"] = $_POST["posti"];
      }
        
        $post_id = $_SESSION["post_id"];

      ////////Shfaq postimin
        $sql_select_post = "SELECT * FROM  posts where id='$post_id'";
        $post = $conn->query($sql_select_post);
        
        while($row = $post->fetch_assoc()){
            ?>
           
        
            <div class='postimi'>
                <h2><?php echo $row['title'];?></h2>
                <p>Posted by</p>
                <p> <?php echo $row['name'];?>  at <?php echo $row['time'];?></p>

            </div>
            <?php
            // echo "<div class='postimi'><br>"."Title:".$row['title']."<br>".$row['post']."<br>"."Posted by"."<br>
            // ".$row['name']." at".$row['time']." "."<br></div>";
        }
        /////



        ////shfaq komentet

       $sql_post_comments = "SELECT * FROM  users u JOIN comments co on u.id = co.usid JOIN posts p on co.pid= p.id where p.id = '$post_id';";
       $comments_made = $conn->query($sql_post_comments);
      
      if(mysqli_num_rows($comments_made) >=1 ) {
          
        echo "<div class='comments'>";
        while ($row_comments = $comments_made->fetch_assoc()) {
            ?>
            <div class='user_comment'>
                <h3><?php echo $row_comments["username"]; ?></h3>
                <p><?php echo $row_comments["content"] ?></p>
            </div>
           
            <?php
             
        }
        echo "<div>";  //////////Fundi iterimit te komenteve 
        ?>
    
            
                <?php
         }
         ////Nuk ka komente
         else{
             echo "No comments are made for this post";
             echo "You may leave a comment below";
             ?>
             <!-- <div>
                <button onclick ="myFunction();"  name="addcomm" >Add a comment</button> 
             </div> -->
    
             <?php
         }
         
         echo "</body>";
    }
    //{

        ///---Shfaq postimin
    //     //$post_id = $_POST["posti"];
    //     $post_id = $_SESSION["post_id"];
    //     $sql_select_post = "SELECT * FROM  posts where id='$post_id'";
    //     $post = $conn->query($sql_select_post);
       
    //     while($row = $post->fetch_assoc()){
    //         echo "<div style='margin-left:20%';><br>"."Title:".$row['title']."<br>".$row['post']."<br>"."Posted by"."<br>
    //         ".$row['name']." at".$row['time']." "."<br></div>";
    //     }

    //     ///Shfaq komentet mbi postin

    //    $sql_post_comments = "SELECT * FROM  users u JOIN comments co on u.id = co.usid JOIN posts p on co.pid= p.id where p.id = '$post_id';";
    //    $comments_made = $conn->query($sql_post_comments);
    //   //iterimi i commenteve tek nje post
    //   if(mysqli_num_rows($comments_made) >=1 ) { 
    //     while ($row_comments = $comments_made->fetch_assoc()) {

    //         echo $row_comments["username"]." commented <br>".$row_comments["content"]."<br>";
             
    //          } 
 
    //      }
    //     //}   
            ?>
 <div style='display:block' id="add_button">
        <input type="button" onclick ="myFunction();" name='addcomml' class="add-button" value="Add a comment3" >
 </div>

<div id='comment_form' style='display:none'>
    <form  action="../blog/comment.php" method="post" >
                    <div><textarea rows="4" cols="100" name='newcomment' placeholder='comment..' id='comment' required></textarea></div>
                <input type="submit" name="shtokoment" id="shto_kom" value="Comment" onclick=''>   
    </form>
    <button onclick="location.href = '../blog/home.php';" id="myButton" class="float-left submit-button" >Home</button>
</div>

</body>

<!-- /////////Koment: Nese useri klikon OK, e dergojme tek logini qe me pas te ridrejtohet tek faqja per te komentuar?> -->

<script>   
 function myFunction() {
    
    var r = confirm("Please type Ok if you want to continue to login and comment  , else click no");
   if (r == true) {
        <?php $_SESSION["logincomment"]=1; ?>
        window.location.href = "../login.php";
        
    } else {
        
    }
    
    }
function checkComment(){
    if(document.getElementById("comment").value==""){
        alert("Please fill the comment area , before submitting the button");
    }
}

</script> 
<?php 
 if(isset($_SESSION["user"])){
        
        echo "<script> 
                document.getElementById('comment_form').style.display = 'block';
                document.getElementById('add_button').style.display = 'none';
                
              </script>";
        
    }  
    else{
      echo "<script> 
                document.getElementById('comment_form').style.display = 'none';
                document.getElementById('add_button').style.display = 'block';
            </script>";
        
      
    }  
?>

</htmL>