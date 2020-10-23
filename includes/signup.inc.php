<?php
include_once('dbh.inc.php');

        $email = $_POST['email-reg'];
        $uname = $_POST['name-reg'];
        $pass = $_POST['pw-reg'];
        $errors = array(); 
        // if(empty($email) ||
        // empty($pass) || empty($uname)){
        //     //header('Location: ../login.php?signup=empty');
        //     echo $email;
        //     echo $uname;
        //     echo $pass;
        // }else{
            // if(!preg_match("/^[a-zA-Z]*&/",$first) || !preg_match("/^[a-zA-Z]*$/",$last)){
            //     header('Location: ../login.php?signup=char');
            //     exit();
            // }else{
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    header('Location: ../login.php?signup=invalidemail');
                }
                else {
                    $user_check_query = "SELECT * FROM users WHERE username='$uname' OR email='$email' LIMIT 1";
                    $result = mysqli_query($conn, $user_check_query);
                    $user = mysqli_fetch_assoc($result);

                    if ($user) { // if user exists
                        //check username if it is unique
                        if ($user['username'] === $uname) {
                            array_push($errors, "Username already exists");
                            echo 'Username exists</br>';
                        }
                    
                        // Check email if it is unique
                        if ($user['email'] === $email) {
                            array_push($errors, "email already exists");
                            echo 'Email exist</br>';
                        }

                        // Check email if it is valid format or not
                        $regex = '/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/'; 
                        if (!preg_match($regex, $email)) {
                            array_push($errors, "is not a valid email. We can not accept it.");
                            echo $user['email'] . " is not a valid email. We can not accept it.";
                        }

                        if (!preg_match("/^[a-zA-Z0-9 ]{8,}$/",$pass)) {
                            array_push($errors, "Only letters,number and white space allowed");
                            echo 'Password is not valid format';
                        }
                    }  

                    //Using prepared statement
                    $sql = "INSERT INTO users(username,pw,email,bdate) VALUES 
                    (?, ?, ?, ?);";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        echo "SQL error";
                    }else{
                        $password = $_POST['pw-reg'];
                        $salt = "d5f332312e3e390c81f6ef9f242c21bf9e472d6296ddd4bebddd0f54eb576f14";
                        $hpassword = hash('sha256', $salt . $password);
            
                        echo 'Inserting user';
                        if(count($errors) == 0){
                        $bdate = '1985-12-12';
                        mysqli_stmt_bind_param($stmt,"ssss", $uname, $pass ,$email,$bdate);
                        mysqli_stmt_execute($stmt);
                        $_SESSION['user']=$data['username'];


                        $result=mysqli_query($conn,"select * from users 
                         where username like '".$uname."' 
                            and pw like '".$pass."';");
                        if(mysqli_num_rows($result)==1){
                            $data=mysqli_fetch_assoc($result);
                        }
                        // echo $data;
                            $sql2 = "INSERT INTO profile_image(userid,status) VALUES (?,?);";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt,$sql2)){
                                echo "SQL error 2";
                            }else{
                                echo 'inserting profile image of user';
                                $zero = 0;
                                mysqli_stmt_bind_param($stmt,"ss", $data['id'],$zero);
                                mysqli_stmt_execute($stmt);
                            }
                            echo 'redirecting';
                            header('Location: ../login.php?signup=success');
                            setcookie("user", $user, time() - 28800, "/");
                            setcookie("email", $clean['email'], time() - 28800, "/");
                            setcookie("bdate", $clean['bdate'], time() - 28800, "/");
                        }else{
                            print_r($errors);
                            $email = $_POST['email-reg'];
                            $uname = $_POST['name-reg'];

                            $_COOKIE['user'] = $uname;
                            $_COOKIE['email'] = $email;
                            $_COOKIE['bdate'] = $_POST['bdate-reg'];
                
                            setcookie("user", $uname, time() + 28800, "/");
                            setcookie("email", $email, time() + 28800, "/");
                            setcookie("bdate", $_POST['bdate-reg'], time() + 28800, "/");
                            echo '<br>';
                            echo "Error: " . $sql . "<br>" . $conn->error;
                            echo '<br><br><br>';
                            echo "<button name = 'register' onclick='location.href = \"../login.php\"'>Go back to the register form</button>";
                            echo '<br><br><br>';
                            echo 'Your data are not valid.<br>Please check them and try again later.<br><br>';
                        }
                    }
                
            }
    //}

   

    // Normal SQL
    // $sql = 'select * from users;';
    // $sql = "INSERT INTO users(user_first,user_last,user_email,username,user_pw) VALUES 
    // ('$first','$last','$email','$uname','$pass');";
    // $result = $conn->query($sql);
   
    // $resultCheck = mysqli_num_rows($result);
    // if($resultCheck > 0){
    //     while($row = mysqli_fetch_assoc($result)){
    //         echo $row['user_id'].'<br>';
    //    }
    //  }

?>
