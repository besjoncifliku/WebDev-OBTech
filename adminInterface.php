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
        table {
            border-spacing: 0px;
        }

        .read0{
            background-color: gold;
            color: #111;
        }

        
        th, td {
            padding: 10px 40px 10px 20px;
            border-spacing: 0px;
            font-size: 90%;
            margin: 0px;
        }

        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: #fff;
            font-size: 20px;
            opacity: 1; /* Firefox */
        }

        th, td {
            text-align: center;
            background-color: transparent;
            font-size: 14px;
            color: #fff;
            font-family: sans-serif;
            text-transform: uppercase;
            font-family: sans-serif;
            cursor: pointer;
            color: #fff;
            border: 1px solid #fff;
        }

        th{
            color: #111;
        }

        input[type='text']{
            border: 3px solid #111;
            padding: 20px;
            color: #fff;
            width: 90%;
            background-color: transparent;
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
                <a href="#home"><i class="fa fa-home fa-2x"></i>
                    <span class="nav-text">
                        Home
                    </span>
                </a>
            </li>

            <li class="subnav">
                <a href="#product"><i class="fa fa-list fa-2x"></i>
                    <span class="nav-text">
                        Add Products
                    </span>
                </a>
            </li>

            <li>
                <a href="#income"><i class="fa fa-chart-line fa-2x"></i>
                    <span class="nav-text">
                        Statistics
                    </span>
                </a>
            </li>

            <li>
                <a href="#course"><i class="fa fa-font fa-2x"></i>
                    <span class="nav-text">
                        Add Courses
                    </span>
                </a>
            </li>

            <li>
                <a href="#account"><i class="fa fa-table fa-2x"></i>
                    <span class="nav-text">
                        Check Users
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
        <div class="image-profile" id="#home">
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
        
        <div class="edit-profile" id="#account">
            <h2>Manage Accounts</h2> 
            <div class="edit-profile-container">
                <div class="edit-password">
                    <form action="includes/deleteAccount.php" method='POST'>
                        <table>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Birthdate</th>
                            <th>Manage</th>
                        </tr>
                            <?php 
                                $sql = 'Select * from users;';
                                $result = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $uname = $row['username'];
                                        $email = $row['email'];
                                        $bdate = $row['bdate'];
                                        echo '<tr>';
                                            echo '<td>'.$uname.'</td>';
                                            echo '<td>'.$email.'</td>';
                                            echo '<td>'.$bdate.'</td>';
                                            echo '<td style="display: none;">
                                                <input style="display: none;" type="text" value="'.$row['id'].'" name="user-id"</td>';
                                            echo '<td><button type = "submit" name="deleteAccount" 
                                                style="background-color: transparent; font-size: 20px; color: #fff;" >DELETE</button> </td>';
                                        echo '</tr>';
                                    }
                                }
                            ?>
                        </table>
                    </form>
                </div>
            </div>
        </div>

        <div class="edit-profile" id="#income">
            <h2>Manage Incomes</h2> 
            <div class="edit-profile-container">
                <div class="edit-password">
                    <table>
                    <tr>
                        <th>No.</th>
                        <th>Date</th>
                        <th>Client</th>
                        <th>Email</th>
                        <th>Income</th>
                    </tr>
                        <?php 
                            $sql_product = 'Select * from invoice;';
                            $result = mysqli_query($conn,$sql_product);
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $no = $row['invoice_id'];
                                    $date = $row['invoice_date'];
                                    $cname = $row['client_name'];
                                    $cemail = $row['client_email'];
                                    $price = $row['inv_price'];
                                    echo '<tr>';
                                        echo '<td>'.$no.'</td>';
                                        echo '<td>'.$date.'</td>';
                                        echo '<td>'.$cname.'</td>';
                                        echo '<td>'.$cemail.'</td>';
                                        echo '<td>'.$price.'$</td>';
                                    echo '</tr>';
                                }
                            }
                        ?>
                    </table>
                    <?php 
                        $sql_price = 'Select sum(inv_price) AS total from invoice;';
                        $result = mysqli_query($conn,$sql_price);
                        $row = mysqli_fetch_assoc($result);
                        echo "<h3 style='font-size: 20px;font-family: sans-serif;'>Total income: ".$row['total']."$</h3>"
                    ?>
                </div>
            </div>
        </div>
 

        <div class="edit-profile" id="#product">
            <h2>Add Products</h2> 
            <div class="edit-profile-container">
                <div class="edit-password">
                    <!-- INSERT INTO store(product_name,product_descr,product_price_was,product_price_is,quantity) VALUES
                        ('Playstation 5','Lorem ipsum dolor sit amet, consectetur
                         adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                          magna aliqua.',1299.99,999.99,3);
                     -->
                     <!-- Inserting a new product into  -->
                     <?php 
                        echo "<form action='includes/uploadStore.inc.php' method = 'POST' enctype = 'multipart/form-data'>
                        <!-- enctype specifies how the form data should be encoded -->
                            <h2 style='font-size: 16px; margin-bottom:5px; margin-top:-5px; color:#111' >Choose an image</h2>
                            <br>
                            <input type='file' name='file' class='file-input'>
                            <br>
                            <input type='text' name='prod_name' placeholder='Product Name'>
                            <br>
                            <input type='text' name='prod_descr' placeholder='Description'>
                            <br>
                            <input type='text' name='prod_price' placeholder='Price'>
                            <br>
                            <input type='text' name='prod_quantity' placeholder='Quantity'>
                            <br>
                            <button type = 'submit' name = 'submit' class='upload-profile'>Proceed</button>
                        </form>";
                     ?>
                </div>
            </div>
        </div>

        <div class="edit-profile" id="#course">
            <h2>Add Courses</h2> 
            <div class="edit-profile-container">
                <div class="edit-password">
                    <!-- insert into course(ctitle,cprice,cimage,cdescription,cvideo) values 
                    ('Full course in React','59.99','images/courses_photo/react.png','Lorem ipsum dolor 
                            sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt 
                             ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                             exercitation ullamco laboris. ','video.mp4');
                     -->
                     <!-- Inserting a new product into  -->
                     <?php 
                        echo "<form action='includes/addCourses.inc.php' method = 'POST' enctype = 'multipart/form-data'>
                        <!-- enctype specifies how the form data should be encoded -->
                            <h2 style='font-size: 16px; margin-bottom:5px; margin-top:-5px; color:#111' >Enter course information.</h2>
                            <br>
                            <input type='text' name='ctitle' placeholder='Course Name'>
                            <br>
                            <input type='text' name='cprice' placeholder='Course Price'>
                            <br>
                            <div style='margin-top:10px; margin-bottom:10px;'>
                                <textarea rows='5' cols='65'
                                     name='cdescription' placeholder='Add course description' class='blog-idea' style='border: 3px solid #111;
                                     background-color: transparent;'></textarea>
                            </div>
                            <button type = 'submit' name = 'submit' class='upload-profile'>Proceed</button>
                        </form>";
                     ?>
                </div>
            </div>
        </div>

        <div class="edit-profile" id="#inbox">
            <h2>INBOX</h2> 
            <div class="edit-profile-container">
                <div class="edit-password">
                    <form action="includes/readMessage.inc.php" method='POST'>
                        <table>
                        <tr>
                            <th>No#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                        </tr>

                            <?php 
                                $sql = 'Select * from messages;';
                                $result = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $name = $row['name'];
                                        $email = $row['email'];
                                        $msg = $row['msg'];
                                        $id = $row['id'];
                                        $class= 'read'.$row['status'];
                                        echo '<tr class="'.$class.'">';
                                            echo '<td>'.$name.'</td>';
                                            echo '<td>'.$email.'</td>';
                                            echo '<td>'.$id.'</td>';
                                            echo '<td style="display: none;">'
                                            ?>
                                                <input style="display: none;" id="mesazh" type="text" value="<?php echo $id ?>" name="msg-id">
                                                
                                            <?php echo '</td>';
                                            
                                                if($row['status']==0){
                                                ?><td><button  
                                                    type = "submit" name="messageRead" onclick="changeName(<?php echo $id ?>);"
                                                style="background-color: transparent; font-size: 20px; color: #fff;" >READ IT</button> </td><?php
                                            }else{
                                                echo '<td>Already Read</td>';
                                            }
                                            
                                        echo '</tr>';
                                    }
                                }else{
                                    echo "<h2>There are no messages in the inbox!</h2>"; 
                                }
                            ?>
                            <script>
                                function changeName(i){
                                    // Set the button that opens the modal
                                    var id =  i;
                                    var x = document.getElementById("mesazh");
                                    x.value = id;
                                    alert(x.value);
                                }
                            </script>
                        </table>
                    </form>
                </div>
            </div>
    </div>
</body>
</html>