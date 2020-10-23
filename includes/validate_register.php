<?php
$out="";

// if (isset($_POST['user']) && isset($_POST['password']))
// {
//     if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
//     {
//         $secret = '';
//         $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
//         $responseData = json_decode($verifyResponse);

//         if($responseData->success)
//         {                   
            // print_r($_COOKIE);

            // header( 'Location: check.php');
//         }
//     }
// }

    $clean=array();
    $clean['username']=$_POST['uname'];
    $clean['password']=$_POST['pw'];
    $clean['name']=$_POST['name'];
    $clean['surname']=$_POST['surname'];
    $clean['bdate']=$_POST['bdate'];
    $clean['email']=$_POST['email'];

	echo "<h1>Youar registration is being validated!</h1>";
	foreach($clean as $key => $val){
		//if($key != 'pass')
		$out.= $key.": ".$val."<br>";
	}
	include_once('configure.php');
    $conn=new mysqli(DB_HOST,USER,PASS,DB);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    try{
        //$conn->beginTransaction();
        $sql="INSERT INTO user (uname,password) 
        VALUES ('{$clean['username']}', '{$clean['password']}')";

        $sql_2="INSERT INTO userInfo (username,password,name,surname,email,bdate) 
        VALUES ('{$clean['username']}', '{$clean['password']}', 
        '{$clean['name']}', '{$clean['surname']}', '{$clean['email']}', 
        '2019-12-13')";
        
        if ($conn->query($sql) === TRUE && $conn->query($sql_2) === TRUE) {
            echo "New record created successfully\n";
            // to disable cookies set time in the past
            setcookie("user", $user, time() - 28800, "/");
            setcookie("hpass", $hpassword, time() - 28800, "/");
            setcookie("name", $clean['name'], time() - 28800, "/");
            setcookie("surname", $clean['surname'], time() - 28800, "/");
            setcookie("email", $clean['email'], time() - 28800, "/");
            setcookie("bdate", $clean['bdate'], time() - 28800, "/");
            header ("Location: login.php?registration=successful");
        } else {
            $user = $_POST['uname'];
            $password = $_POST['pw'];

            $salt = "d5f332312e3e390c81f6ef9f242c21bf9e472d6296ddd4bebddd0f54eb576f14";


            $hpassword = hash('sha256', $salt . $password);

            $_COOKIE['user'] = $user;
            $_COOKIE['name'] = $clean['name'];
            $_COOKIE['surname'] = $clean['surname'];
            $_COOKIE['email'] = $clean['email'];
            $_COOKIE['bdate'] = $clean['bdate'];
            $_COOKIE['pass'] = $hpassword;

            setcookie("user", $user, time() + 28800, "/");
            setcookie("name", $clean['name'], time() + 28800, "/");
            setcookie("surname", $clean['surname'], time() + 28800, "/");
            setcookie("email", $clean['email'], time() + 28800, "/");
            setcookie("bdate", $clean['bdate'], time() + 28800, "/");
            setcookie("hpass", $hpassword, time() + 28800, "/");
            echo '<br>';
            echo "Error: " . $sql . "<br>" . $conn->error;
            echo '<br><br><br>';
            echo "<button name = 'register' onclick='location.href = \"register.php\"'>Go back to the register form</button>";
            echo '<br><br><br>';
            echo 'Your data are not valid.<br>Please check them and try again later.<br><br>';
        }
        //$conn->commit();
    }catch (Exception $e){
       // $conn->rollback();
       echo $e;
    }
    
    $conn->close();
	echo $out;
	$file=fopen($clean['name'].".txt",'w');//Shkrimi ne file...
	fwrite($file,$out);
	fclose($file);

?>
