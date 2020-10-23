<?php
    include_once 'includes/dbh.inc.php';
    
     session_start();

    // if(isset($_POST['add_to_cart'])){
        

    //     if(isset($_SESSION["shopping cart"]))
    //     {
    //         $_item_array_id = array_column($_SESSION["shopping_cart"],"item_id");
    //         if(!in_array($_GET["id"],$item_array_id))
    //             {
    //                 $count = count($_SESSION["shopping_cart"]);
    //                 $item_array = array(
    //                     'item_id'   =>  $_GET['id'],
    //                     'item_title'   =>  $_POST['hidden_title'],
    //                     'item_price'   =>  $_POST['hidden_price']
    //                 );
    //                 $_SESSION["shopping_cart"][$count] = $item_array;
    //             }
    //             else{

    //                 echo '<script> window.location="academy.php"</script>'; 
    //             }
    //     }
    //     else{
    //         $item_array = array(
    //             'item_id'   =>  $_GET['id'],
    //             'item_title'   =>  $_POST['hidden_title'],
    //             'item_price'   =>  $_POST['hidden_price']

    //         );

    //         $_SESSION["shopping_cart"][0] = $item_array;

    //     }
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/stilim.css" type="text/css">
    <link rel="stylesheet" href="style/navbar.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/8e71d0b45b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/stilim.css">
    <title>Academy</title>
    
    
</head>
<style>
    .bought-course{
        border-style:solid;
        border-width:3px;
        border-color: lightgreen;
    }

    .kursi{
        border: 3px solid #fff;
        padding: 20px;
        border-radius: 50%;
        width: 150px;
        height: 150px;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }
    .cimage{
        width: 65;
        height:65px;
        margin: auto;
    }

</style>
<body >
<header class="header">
    <nav class="nav">
        <ul>
        <?php 
                if(isset($_SESSION["user"])){
                    echo ' <li class="submenu"  onmouseout="hamburgerOut();">
                    <a href="userInterface.php" id="submenu">
                        <i class="fas fa-bars"></i></a></li>';
                }else{
                    echo '<li class="submenu"  onmouseout="hamburgerOut();">
                    <a href="#" id="submenu" onmouseover="hamburgerIn();">
                        <i class="fas fa-bars"></i></a></li>';
                }
                ?>
                <li><a href="index.html">Home</a></li>
                <li><a href="blog/home.php">Blog</a></li>
                <li><a href="academy.php" class="active">Academy</a></li>
                <li><a href="#">Home</a></li>
                <li onmouseout="logoWhite();"><a href="#" id="logoHover" onmouseover="logoBlack();"><img src="images/logo_2.png" class = "logo" alt="Logo"></a></li>
                <li><a href="#">Services</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about.php">About Us</a></li>
                <?php 
                    if(isset($_SESSION["user"])){
                        echo '<li class="login"><a href="includes/logout.inc.php"><span><i class="fas fa-sign-in-alt"></i></span>   Log Out</a></li>';
                    }else{
                        echo '<li class="login"><a href="login.php"><span><i class="fas fa-sign-in-alt"></i></span>   Log In</a></li>';
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
                document.getElementById('logoHover').innerHTML = '<img src="images/logo_2.png" class = "logo" alt="Logo">';
            }

            function logoBlack(){
                document.getElementById('logoHover').innerHTML = '<img src="images/logo_2Black.png" class = "logo" alt="Logo">';
            }
        </script>
    </nav>
</header>

<div class='container'>
    <div style='' class='courses'>
            <div class="info_details">
                <?php
                    ///-- Showing user 
                    if(isset($_SESSION["user"])){
                        $username = $_SESSION['user'];
                        $sql = "SELECT * from users where username ='$username';";
                        $user = mysqli_query($conn,$sql);
    
                        while ($row = mysqli_fetch_assoc($user)) {
                            $user_details =$row["username"] ;
                            //echo $user_details;      
                        }
                    } 
                    //mysqli_close($conn);
                    //////----
                ?>
            </div>
        <br>
        <?php   
            //-----Insert a new course ------
                // $sql_insert = "insert into course(ctitle,cprice,cimage,cdescription,cvideo) values
                // ('Full course in Mysql','27.5','courses_photo/mysql.png','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. ','video.mp4');";
                //  $conn->query($sql_insert); 
        
                // $sql_insert = "INSERT INTO users(username,pw,email,bdate) VALUES ('omalkja','admin','omalkja17@epoka.edu.al','1998-12-05')";
                // $conn->query($sql_insert); 
            //-- Showing courses in the left part
            //if(!isset($_SESSION["user"])){
            $sql_courseselect = "SELECT * FROM course ";
            $result = $conn->query($sql_courseselect); 
            $nr_courses = 0;
        ?>
                <div class='courses-display' style="">
                    <?php 
                        while($row = $result->fetch_assoc()){
                            $nr_courses++;
                    ?>
                    <div  class='kursi' id="<?php echo $row["cid"];?>" onclick="klikaj(<?php echo $row['cid']; ?>);">
                        <img  class='cimage' src="<?php echo $row["cimage"]; ?>" > <br> 
                        <span><?php echo $row['ctitle']; ?> </span>
                        <br>  <span> $<?php echo $row['cprice']; ?> </span>
                        <br>           
                    </div>
                <?php
                        }
                    //}
                ?>
                </div>
            <div>
                </div>
                <?php
                    ///  ////------
                ?>
            </div>
    <div class='courses_right'>           
        <?php
            $sql = "SELECT * FROM course ";
            $result = $conn->query($sql); 
            
            while($row = $result->fetch_assoc()){
                
        ?>

        <div style='display:none' id="<?php echo $row["cid"].'m';?>">

                <div class='course-description'>
                        <form action = "<?php if(isset($_SESSION["user"])){echo "includes/purchase.inc.php";} else{echo "login.php";} ?>" method="post">
                        <input type="hidden" id="courseid" name="courseid" value="<?php echo $row["cid"];?>">
                        <img class='cimage' src="<?php echo $row["cimage"]; ?>" > <br> 
                        <span class='course-description-header'><?php echo $row['ctitle']; ?> </span><br>
                        <span> <?php echo $row['cdescription']; ?></span>
                        <video width="600" height="250" autoplay controls>
                            <source src="<?php echo $row['cvideo']; ?>"  type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <br> Price <span><?php echo $row['cprice']?> </span>
                        <input type='submit' name='buy' class="buy" style='' value='Buy now'>       
                        </form>
                    <!-- <form method="post" action="academy.php?action=add&id='<?php echo $row["cid"].'m';?>'">
                        <input type='hidden' name='hidden_title' value='<?php echo $row["ctitle"]; ?>'>
                        <input type='hidden' name='hidden_price' value='<?php echo $row['cprice']?>'> 
                        <input type='submit' name='add_to_cart' style='margin-top:10px; background-color:green' value='Add to Cart'>       
                    </form> -->
                </div>
                <!-- <?php if(isset($_POST["buy"]) && !isset($_SESSION["user"])) {
                    echo" <script>
                        
                    function myFunction() {
                        var txt;
                        if (confirm('Do you want to continue to login in order to buy a course? If so click yes and you will be redirected to login page')) {
                        <?php header(Location: 'includes/purchase.inc.php'); ?>
                        } else {
                        <?php header(Location: 'login.php'); ?>
                        }
                        
                    }
                    </script>";

                }
                ?> -->
        </div>
        <br>     
        <?php
            }
        ?>
    <?php
        ///////--- Show only the courses that the user has bought
            if(isset($_SESSION["user"])){
            $username = $_SESSION["user"];

            //Marrja e id se userit
            $sql = "SELECT id FROM users where username='$username';";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
            $userid =  $row['id'];
            }
            // if(isset($_POST["courseid"])){
            //     $course_id = $_POST["courseid"];
            // }

            
            $sql_user_course = "SELECT * FROM  users u JOIN user_course uc on u.id = uc.userid JOIN course c on uc.courseid= c.cid where u.id = '$userid';";
            $courses_bought = $conn->query($sql_user_course);
            while ($row = $courses_bought->fetch_assoc()) {
                    
                ?>
                
                <div class='bought-course'>
                    <img class='cimage' src='<?php echo $row["cimage"]; ?>'> <br> 
                    <span><?php echo $row['ctitle']; ?> </span><br>
                    <span> <?php echo $row['cdescription']; ?></span>
                    <video width='600' height='250' autoplay controls>
                        <source src="<?php echo $row['cvideo']; ?>"  type='video/mp4'>
                        Your browser does not support the video tag.
                    </video>
                    <!-- <br> Price <span><?php echo $row['cprice']."$"?> </span> -->
                    
                </div>
                <br>
                <?php
                }
            }
        /////////--- End of display of courses of a certain user
        ?>
            <!-- <div class="order_details">
                <table>
                    <tr>
                        <th>Course title</th>
                        <th>Course price</th>
                        <th>Action</th>
                    </tr>
                        <?php
                        if(!empty($_SESSION["shopping_cart"])){
                            $total = 0;
                            foreach($_SESSION["shopping_cart"] as $keys => $values){

                        ?>
                    <tr>
                        <td><?php echo $values["item_title"]; ?></td>
                        <td><?php echo $values["item_price"]; ?></td>
                        <td><a href="academy.php?action=delete&id=<?php echo $values["item_id"]; ?>">Remove</a></td>       
                    </tr>
                        <?php 
                        $total = $total + $values["item_price"];
                    
                            }
                            ?>
                            <tr>
                                <td><?php echo "Totali: ". $total ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
            </div> -->
         </div>                   
    </div>
    <script type="text/javascript">
        function klikaj(i) {
          document.getElementById(i+'m').style.display='block';
       
          <?php 
           global $nr_courses;
            ?>
           for(var j =1 ;j<= <?php echo $nr_courses; ?>;j++){
               if(j!=i){
                document.getElementById(j+'m').style.display='none';
               }
           }


        }
       
     </script>
</body>
</html>