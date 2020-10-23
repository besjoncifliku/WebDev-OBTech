<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LogIn</title>
    <script src="https://kit.fontawesome.com/8e71d0b45b.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" href="style/login.css">
</head>
<body>
    <div class="shadow-box">
        
    </div>
    <section>
        <div class="container">
            <div class="login-box" id='login-box'>
                <form action="includes/login.inc.php" method = "POST">
                    <img src="images/login/profile.png" class="avatar">
                     <h2 class="login-header">LOGIN</h2>
                     <input type="text" name='username' placeholder='Username' id='uname'
                        value = "<?php echo (isset($_COOKIE['user']))?$_COOKIE['user']:'';?>">
                     <br>
                     <input type="password" name='pass' placeholder='Password' id='pass'>
                     <div class="login-butt">
                     <h2 class="login-button" onclick = 'fireLogin();'><i class="fas fa-sign-in-alt"></i>Login</h2>
                     <h3 class="forgot-password">Forgot password</h3>
                     <input id="log" class="disable" type="submit">
                     </div>   
                </form>
            </div>
            <div class="login disable" id = 'login'>
                <a href="#"  onclick="animate_login('login');">
                    <span><i class="fas fa-sign-in-alt"></i></span> Login</a>
                <p>You already have<br>an account?</p>
            </div>
           
            <div class="signup-box disable" id='signup-box'>
                <form action="includes/signup.inc.php" method='POST'>
                    <h2 class="register-header">Register</h2>
                    <input type="text" placeholder="Username" name="name-reg" id="name-reg" 
                        value = "<?php echo (isset($_COOKIE['user']))?$_COOKIE['user']:'';?>">
                    <br>
                    <input type="password" placeholder="Password" name="pw-reg" id="pw-reg"> 
                    <br>
                    <input type="password" placeholder="Confirm Password" name="cpw-reg" id="cpw-reg">
                    <br>
                    <input type="email" placeholder="Email" class="disable" name="email-reg" id="email-reg" 
                        value = "<?php echo (isset($_COOKIE['email']))?$_COOKIE['email']:'';?>">
                    <br>
                    <input type="date" placeholder="Birthday" class="disable" name="bdate-reg" id="bdate-reg" 
                        value = "<?php echo (isset($_COOKIE['bdate']))?$_COOKIE['bdate']:'';?>"> 
                    <br>
                    <a href="#" id="next" onclick="next('next');"><span><i class="fas fa-forward"></i></span> Next</a>
                    <br>
                    <div class="terms-condition" class="disable" id="terms">
                        <input type="checkbox" name="conditions" id='term' value="terms"><a target='_blank' href="https://www.termsandconditionsgenerator.com/live.php?token=Te3YoPg7pUKpEMtDZXlPCiP8dpuIr8My" class="terms"> 
                            Terms & Conditions </a>
                    </div>
                    <a href="#" id="back" onclick="next('back');" class="disable"><span><i class="fas fa-backward"></i></span> Back</a>
                    <br>
                    <br>
                    <a href="#" id="signup-reg" name='signup-reg' onclick='fireSignup();' class="disable"><i class="fas fa-user-plus"></i></span>Sign Up</a>
                    <input id="sing" type="submit" class="disable">
                </form>                   
            </div>    
            <div class="signup" id='signup'>
                <a href="#"  onclick="animate_login('signup');">
                    <span><i class="fas fa-user-plus"></i></span> Signup</a>
                <p>Become a memeber of <br>the family...</p>
            </div>
        </div>
    </section>

    <script>
        function animate_login(i){
            if(i==='login'){
                document.getElementById("signup-box").classList.add('disable');
                document.getElementById("login").classList.add('disable');
                document.getElementById("signup").classList.remove('disable');
                document.getElementById("login-box").classList.remove('disable');
            }else if(i==='signup'){
                //$('.login-box').fadeIn();
                //$('.signup-box').fadeOut();
                document.getElementById("login-box").classList.add('disable');
                document.getElementById("signup").classList.add('disable');
                document.getElementById("login").classList.remove('disable');
                document.getElementById("signup-box").classList.remove('disable');
                document.getElementById('terms').classList.add('disable');
            }
        }

        function next(variable){
            if(variable === 'next'){
                document.getElementById("name-reg").classList.add('disable');
                document.getElementById("pw-reg").classList.add('disable');
                document.getElementById("cpw-reg").classList.add('disable');
                document.getElementById("next").classList.add('disable');
                document.getElementById("email-reg").classList.remove('disable');
                document.getElementById("bdate-reg").classList.remove('disable');
                document.getElementById("signup-reg").classList.remove('disable');
                document.getElementById('back').classList.remove('disable');
                document.getElementById('terms').classList.remove('disable');
            }else if(variable==='back'){
                document.getElementById("name-reg").classList.remove('disable');
                document.getElementById("pw-reg").classList.remove('disable');
                document.getElementById("cpw-reg").classList.remove('disable');
                document.getElementById("email-reg").classList.add('disable');
                document.getElementById("bdate-reg").classList.add('disable');
                document.getElementById("signup-reg").classList.add('disable');
                document.getElementById('next').classList.remove('disable');
                document.getElementById('back').classList.add('disable');
                document.getElementById('terms').classList.add('disable');

            }
        }

        function fireLogin(){
            if(document.getElementById('uname').value==="" || document.getElementById('pass').value==="")
                 alert('You have to complete all fields');

            else{
                var button = document.getElementById("log");
                button.click();
            }
        }

        function fireSignup(){
            if(document.getElementById('name-reg').value==="" || document.getElementById('pw-reg').value==="" 
                || document.getElementById('email-reg').value==="" || document.getElementById("bdate-reg").value==='')
            {
                alert('You have to complete all fields');
            }else{
                if(document.getElementById("pw-reg").value===document.getElementById("cpw-reg").value){
                    if(document.getElementById("term").checked){
                        var button = document.getElementById("sing");
                        button.click();
                    }else{
                        alert('Accept terms and condition in order to continue!');  
                    }
                }else{
                    alert('The password field should match!');  
                }
               
            } 
        }
    </script>
</body>
</html>