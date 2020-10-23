<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="Web Design">
    <meta name="author" content="Besjon Cifliku">
    <title>About</title>
    <link rel="stylesheet" href="style/about.css" type="text/css">
    <script src="https://kit.fontawesome.com/8e71d0b45b.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/input.css">
    <style>  
        @media only screen and (max-width: 800px) {
            body {
              display: block;
            }
            nav{
              display: none;
            }
            .testimonial-content{
              line-height: 100px;
              float: none;
            }
            .author-section .author{
              float: none;
              text-align: center;
              width: 100%;
            }

            .author-section{
              text-align: center;
            }

            .contact{
              display:none;
            }
        }
    </style>
  </head>
  <body>
    <header>
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
                <li><a href="academy.php">Academy</a></li>
                <li><a href="#">Home</a></li>
                <li onmouseout="logoWhite();"><a href="#" id="logoHover" onmouseover="logoBlack();"><img src="images/logo_2.png" class = "logo" alt="Logo"></a></li>
                <li><a href="#">Services</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about.php"  class="active">About Us</a></li>
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
    <main>
      <section class="about">
        <div class="container">
            <h1>We are a small group working with web technologies!</h1>
            <p>If you like our work you can subscribe in our channel!</p>
            <div class="btn-about">
              <button type="submit" class="button-2"><i class="fas fa-heart"></i>Subscribe</button>
              <button type="submit" class="button-3"><i class="fas fa-thumbs-up"></i>Like Channel</button>
            </div>
        </div>
      </section>
      <section class="testimonial-section">
        <div class="container">
          <div class="inner-width">
            <h1>Few words from our clients</h1>
            <div class="testimonial-pics">
              <img src="images/pers1.jpg" alt="test-1" class="active">
              <img src="images/pers2.jpg" alt="test-2">
              <img src="images/pers3.jpg" alt="test-3">
              <img src="images/pers4.jpeg" alt="test-4">
            </div>

            <div class="testimonial-content">

              <div class="testimonial active" id="test-1">
                <p>Lorem sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <span class="testimonial-person">Emy / Developer</span>
              </div>

              <div class="testimonial" id="test-2">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <span class="testimonial-person">Carla / Designer</span>
              </div>

              <div class="testimonial" id="test-3">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <span class="testimonial-person">Joseph / Programmer</span>
              </div>

              <div class="testimonial" id="test-4">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore quis nostrud exercitation ullamco laboris nisi ut aliquip consequat.</p>
                <span class="testimonial-person">Anna / Designer</span>
              </div>

            </div>
          </div>
        </div>
      </section>

      <script type="text/javascript">
        $('.testimonial-pics img').click(function(){
          $('.testimonial-pics img').removeClass("active");
          $(this).addClass("active");

          $(".testimonial").removeClass("active");
          $("#"+$(this).attr("alt")).addClass("active");
        })
      </script>

      <section class="author-section">
        <div class="container">
          <h1 id="author-title">OUR AM<i class="fas fa-heartbeat" fa-1x></i>ZING CREW</h1>
          <div class="author">
            <img src="images/author1.png" alt="Anna Katherina">
            <h1>Anna Katherina</h1>
            <p>I am a young student who likes DESIGN. I like reading in free time.</p>
            <div class="social-media-btn">
              <a href="#" class="btn-link">
                <i class="fab fa-facebook"></i>
              </a>
              <a href="#" class="btn-link">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="btn-link">
                <i class="fab fa-instagram"></i>
              </a>
            </div>
          </div>
          <div class="author">
            <img src="images/author2.png" alt="Angela Conti">
            <h1>Angela Conti</h1>
            <p>I am a computer engineer and smoke addicted :)</p>
            <div class="social-media-btn">
              <a href="#" class="btn-link">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="btn-link">
                <i class="fab fa-tumblr-square"></i>
              </a>
              <a href="#" class="btn-link">
                <i class="fab fa-instagram"></i>
              </a>
            </div>
          </div>
          <div class="author">
            <img src="images/author3.png" alt="Gigi Hadid">
            <h1>Gigi Hadid</h1>
            <p>I am a top-model, but in my free time I like to experiment with web designs.</p>
            <div class="social-media-btn">
              <a href="#" class="btn-link">
                <i class="fab fa-facebook"></i>
              </a>
              <a href="#" class="btn-link">
                <i class="fab fa-youtube"></i>
              </a>
              <a href="#" class="btn-link">
                <i class="fab fa-instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </section>

      <section class="contact">
        <div class="contact-container">
          <form action="includes/sendMessage.inc.php" method='POST'>
            <div class="form name">
              <input type="text" name="name" autocomplete="off" required />
              <label for="name" class="label-name">
                <span class="input-content"><i class="fas fa-user-circle"></i>Username</span>
              </label>
            </div>

            <div class="form email">
              <input type="text" name="email" autocomplete="off" required />
              <label for="name" class="label-name">
                <span class="input-content"><i class="fas fa-envelope-open"></i>Email</span>
              </label>
            </div>

            <div class="form Message">
              <input type="text" name="message" autocomplete="off" required />
              <label for="name" class="label-name">
                <span class="input-content"><i class="fas fa-comment-dots"></i>Message</span>
              </label>
            </div>

            <button type="submit" class="submit" name="submit">
              <span><i class="fab fa-telegram-plane"></i></span> Send Message
            </button>
          </form>
        </div>
      </section>
    </main>
    <footer>
      <p>OBTechnology, Copyright &copy 2020</p>
    </footer>
  </body>


</html>
