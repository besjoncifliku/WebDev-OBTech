<?php
    session_start();
    include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8e71d0b45b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/userInterface.css">
    <title>Home</title>
    <style>
        .bought-course{
            width:500px;
            height:500px;
        }

        .blog-post{
            margin-top: 150px;
            margin-bottom: 150px;
        }

        input[type='text'],input[type='password']{
            border: 3px solid #32a0c2;
            padding: 20px;
            color: #fff;
            width: 50%;
            background-color: transparent;
        }

        .blog-idea{
            border: 3px solid #32a0c2;
            padding: 35px;
            color: #fff;
            background-color: transparent;
        }

        .blog-post-buttons{
            border: 3px solid #32a0c2;
            padding: 25px;
            text-align: center;
            background-color: transparent;
            width: 50%;
            color: #fff;
            cursor: pointer;
            transition: 0.4s;
            font-family: sans-serif;
            letter-spacing: 9px;
            font-weight: 600;
            text-transform: uppercase;
            font-family: sans-serif;
        }

        .blog-post-buttons:hover{
            background-color: #111;
            color: #fff;
        }

        .blog-post h2{
            line-height: 50px;
            color: #fff;
            font-family: sans-serif;
            letter-spacing: 9px;
            font-weight: 600;
            text-transform: uppercase;
            font-family: sans-serif;
            font-size: 24px;
            text-decoration: none;
            text-transform: uppercase;
            margin-bottom: 55px
        }

        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: #fff;
            font-size: 20px;
            opacity: 1; /* Firefox */
        }
        .course-information{
            visibility:hidden;
            transition: 0.4s all ease;
        }

        .bought-course .course-image:hover+.course-information{
            visibility: visible;
        }

        table { 
            display: table;
            border-collapse: collapse;
            border-spacing: 10px;
            border-color: gray;
            width: 70%;
        }
        table, td, th {
            border: 1px solid white;
        }

    </style>
</head>
<body>
<div class="area"></div>
    <nav class="main-menu">
        <ul>
            <li class="image-profile">
               <?php
                    $sql = 'Select * from users where id ='.$_SESSION['id'];
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            //$id = $row['id'];
                            $uname = $row['username'];
                            $sqlImage = 'select * from profile_image where userid ='.$_SESSION['id'];
                            $resultImg = mysqli_query($conn,$sqlImage);
                            while($rowImg = mysqli_fetch_assoc($resultImg)){
                                echo "<div class = 'user-container'>";
                                    if($rowImg['status'] == 1){     
                                        $filename = 'uploads/profile'.$_SESSION['id']."*";
                                        // glob -> function that searches for a specific file that we have partial name that we are looking for
                                        $fileinfo = glob($filename);
                                        // just for the first one
                                        $fileExt = explode('.',$fileinfo[0]);
                                        $fileactualExt = $fileExt[1]; //jpg not the name 
                                        echo "<img class='profileImage' src = 'uploads/profile".$_SESSION['id'].".".$fileactualExt."?".mt_rand()."'>";
                                    }else{
                                        echo "<img class='profileImage' src = 'uploads/profiledefault.png'>";
                                    }
                                    echo $uname;
                                echo "</div>";
                            }
                        }
                    }else {
                        echo 'There are no user registered';
                    }

               ?>
            </li>

            <li class="subnav">
                <a href=""><i class="fa fa-home fa-2x"></i>
                    <span class="nav-text">
                        Home
                    </span>
                </a>
            </li>

            <li class="subnav">
                <a href=""><i class="fa fa-laptop fa-2x"></i>
                    <span class="nav-text">
                        Store
                    </span>
                </a>
            </li>

            <li class="subnav">
                <a href=""><i class="fa fa-list fa-2x"></i>
                    <span class="nav-text">
                        Forms
                    </span>
                </a>
            </li>

            <li>
                <a href=""><i class="fa fa-font fa-2x"></i>
                    <span class="nav-text">
                        MyAcademy
                    </span>
                </a>
            </li>

            <li>
                <a href=""><i class="fa fa-info fa-2x"></i>
                    <span class="nav-text">
                        Info
                    </span>
                </a>
            </li>

        </ul>

        <ul class="logout">
            <li>
                <form action="includes/logout.inc.php">
                    <a href="includes/logout.inc.php">
                    <i class="fa fa-power-off fa-2x"></i>
                    <span class="nav-text">
                            Log Out
                        </span> 
                    </a>
                </form>
            </li>
        </ul>
    </nav>
    <!-- userInterface used to display information from the user  -->
    <div class="userInterface">
        <div class="image-profile">
            <h2>Edit your profile image</h2>
            <div class="line-header">

            </div>
            <?php
                if(isset($_SESSION['id'])){
                    
                    echo '<h3>You are logged in as user #'.$_SESSION['id'].'</h3>';
                    
                    echo "<form action='includes/upload.inc.php' method = 'POST' enctype = 'multipart/form-data'>
                    <!-- enctype specifies how the form data should be encoded -->
                        <input type='file' name='file' class='file-input'>
                        <br>
                        <button type = 'submit' name = 'submit' class='upload-profile'>Upload</button>
                    </form>";

                    echo "<form action='includes/delete.inc.php' method = 'POST'>
                        <button type = 'submit' name = 'delete' class='delete-file'>Delete</button>
                    </form>";
                }
            ?>
        </div>
        <div class='account-info'>
            Welcome to your account: <?php echo $_SESSION['user'];?>
            <br>
            Email address is: <?php echo $_SESSION['email'];?><br>
            Your birthdate: <?php echo $_SESSION['bdate'];?>
        </div>
        <div class="blog-post">
            <h2>What do you have in mind?</h2>
            <div id="post" class=''>
                 <div class="post-section">
                     <form action='blog/post.php' method='post'>
                        <div><input type='text' name='title' placeholder ='Title:' class='blog-title'></div>
                        <!-- <input type="text" name='des' placeholder="describe.."> -->
                        <div style='margin-top:10px; margin-bottom:10px;'><textarea rows="5" cols="85" name='des' placeholder='Share your thoughts...' class='blog-idea'></textarea></div>
                        <div><input type='submit' onclick="" value='post' name='share' class='blog-post-buttons'></div>
                    </form>
                 </div>
            </div>
        </div>

        <div class="edit-profile">
            <h2>Edit Account</h2> 
            <div class="edit-profile-container">
                <div class="edit-password">
                    <form action='editPassword.php' method='post'>
                    <div><input type='password' name='oldPassword' placeholder ='Old Pass:' class='old-title'></div>
                    <div><input type='password' name='newPassword' placeholder ='New Pass:' class='new-title'></div>
                    <div><input type='submit' onclick="" value='Save changes' name='changePass' class='changePass'></div>
                    </form>
                </div>
                <div class="edit-username">
                    <form action='editUsername.php' method='post'>
                    <div><input type='text' name='oldUsername' placeholder ='Old:' value=<?php echo $_SESSION['user'] ?> class='old-title'></div>
                    <div><input type='text' name='newUsername' placeholder ='New User:' class='new-title'></div>
                    <div><input type='submit' onclick="" value='Save changes' name='changeUser' class='changeUser'></div>
                    </form>
                    <script>

                    </script>
                </div>
            </div>
        </div>

        <div class="buy_course">
            <h2>Buy a new Course</h2> 
            <table cellspacing=12>
                <tr>
                    <th>Course title</th>
                    <th>Price</th>
                    <th>Image</th>
                </tr>
                <?php 
                   $sql_courseselect = "SELECT * FROM course ";
                   $result = $conn->query($sql_courseselect);
                   while($row = $result->fetch_assoc()){
                       
                       ?>
                <tr>
                   <form action='includes/purchase.inc.php' method='post'>        
                    <td><?php echo $row["ctitle"]; ?></td>
                    <td><?php echo $row["cprice"]; ?></td>
                    <td><img style='width:100px; height:100px; border-radius:60px;' src="<?php echo $row['cimage']; ?>"> </td>
                    <td><input type='submit' name='bli_kurs' class="buy" style='' value='Buy now'> </td>
                    <td><input type="hidden" value ="<?php echo $row['cid'];?>" name='kursi_blere'></td>
                   </form>      
                </tr>
                       <?php
                   }
                ?>
            </table>
        </div>

        <div class="myCourses">
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
                echo "<h3 class='course-header'>My Courses</h3><br>";
                while ($row = $courses_bought->fetch_assoc()) {
        ?>
        <div class='bought-course'>
            <div class="course-image">
                <img class='cimage' src='<?php echo $row["cimage"]; ?>'>  
                <h2><?php echo $row['ctitle']; ?> </h2>
            </div>
            <div class="course-information">
                <span> <?php echo $row['cdescription']; ?></span>
                <video width='600' height='250' autoplay controls>
                    <source src="<?php echo $row['cvideo']; ?>"  type='video/mp4'>
                    Your browser does not support the video tag.
                </video>
                <!-- <br> Price <span><?php echo $row['cprice']."$"?> </span> -->
            </div>
        </div>
        <br>
        <?php
                }
            }
        /////////--- End of display of courses of a certain user
        ?>  
        </div>
    </div>
</body>
</html>