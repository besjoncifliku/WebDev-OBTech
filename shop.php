<?php
    include_once 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/shop.css">
    <!-- This link is used to make the slider in the store site -->
    <link rel="stylesheet" href="style/navbar.css">
    <script src="https://kit.fontawesome.com/8e71d0b45b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <title>Store</title>
    <style>
        
        @media only screen and (max-width: 800px) {
            body {
            display: block;
            }

            .store{
                display: block;
                flex-wrap: nowrap;
                
            }
            .store .store-container{
                width: 80%
            }

            .shop-oferta{
                display: block;
            }
            .shop-bar{
                height: 300px;
            }

            ul li .noDisplay{
                display: none;
            }
        }
    </style>
</head>
<body>
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
                <li><a href="academy.php">Academy</a></li>
                <li><a href="#">Home</a></li>
                <li onmouseout="logoWhite();"><a href="#" id="logoHover" onmouseover="logoBlack();"><img src="images/logo_2.png" class = "logo" alt="Logo"></a></li>
                <li><a href="#">Services</a></li>
                <li><a href="shop.php" class="active">Shop</a></li>
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

    <!-- The Modal -->
    <div id="myModal" class="modal">
    <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Make the payment</h2>
            </div>
            <div class="modal-body">
                <p>You need to fill this form below:</p>
                <form action="includes/pay.inc.php" method='POST'>
                    <div class="form">
                        <label for="name" class="label-name">
                            <span class="input-content"><i class="fas fa-user-circle"></i>Username</span>
                        </label><br>
                        <input type="text" name="name" autocomplete="off" required />
                    </div>
                    <div class="form">
                        <label for="name" class="label-name">
                            <span class="input-content"><i class="fas fa-user-circle"></i>Email</span>
                        </label><br>
                        <input type="email" name="email" autocomplete="off" required />
                    </div>
                    <div class="form">
                        <label for="name" class="label-name">
                            <span class="input-content"><i class="fas fa-user-circle"></i>Card Number</span>
                        </label><br>
                        <input type="text" name="card-number" autocomplete="off" required />
                    </div><br>
                    <div class="form" style='display: none;'>
                        <input type="text" class='suck' name="product-id" autocomplete="off" required />
                    </div><br>
                    <button type="submit"  name='payPal'>Pay it now</button>
                </form>
            </div>
        </div>
    </div>

    <section class="shop-cover">
        <div class="shop-container">
            <h1>New technology is here!</h1>
            <p>The impact of technology in modern life is unmeasurable. <br>
               we use technology in different ways.</p>
        </div> 
    </section>
    <h1 class="shop-links-header">Shop your dreams</h1>
    <section class="shop-links">
        <div class="shop-container-links">
    		<a href="#">	
                <div class="boxlink-square">
                    <i class="fas fa-gamepad ha"></i>
                    <h3>Gaming</h3>
                </div>
            </a>
            <a href="#">
                <div class="boxlink-square boxlink-rectangle">
                    <i class="fas fa-desktop"></i>
                    <h3>Workstations</h3>
                </div>
            </a>
            <a href="#">
                <div class="boxlink-square">
                    <i class="fas fa-laptop-code"></i>
                    <h3>Bussiness</h3>
                </div>
            </a>
            <a href="#">
                <div class="boxlink-square boxlink-rectangle">
                    <i class="fab fa-playstation"></i>
                    <h3>Toys & Entertainment</h3>
                </div>
            </a>	
            <a href="#">
                <div class="boxlink-square">
                    <i class="fas fa-mobile-alt"></i>
                    <h3>Phones</h3>
                </div>
            </a>
            <a href="#">	
                <div class="boxlink-square">
                    <i class="fas fa-cog"></i>
                    <h3>Services</h3>
                </div>
            </a>
        </div>
    </section>   
    
    
    <section class="shop-oferta">
        <div class="oferta-image">
            <img src="./images/oferta.jpg" alt="Oferta">
        </div>
        <div class="oferta-description">
            <h1>30% Sale</h1>
           
            <p> Best Assassin's Creed Game <br> Buy now and save 30 % in this iconic game</p>
            <div class="oferta-icons">
                <a href="#" class="buy"><span><i class="far fa-money-bill-alt"></i></span> Buy now</a>
                <a href="#" class="cart" onclick="popUp();"><span><i class="fas fa-shopping-cart"></i></span> Add to cart</a>
            </div>
        </div>
        <script>
            function popUp(){
                Swal.fire(
                    'Good job!',
                    'Your product is added to cart!',
                    'success'
                    )
            }
        </script>
    </section>

    <section class="shop-bar">
        <div class="info-bar">
            <i class="fas fa-search-dollar"></i>
            <p>Chose the product you love <br> Lorem ipsum dolor sit amet.</p>
        </div>

        <div class="info-bar">
            <i class="fab fa-cc-amazon-pay"></i>
            <p>Pay 30 % less online <br> Lorem ipsum dolor sit amet.</p>
        </div>

        <div class="info-bar">
            <i class="fas fa-smile-wink"></i>
            <p>Have fun with it <br> Lorem ipsum dolor sit amet.
            </p>
        </div>
    </section>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        function open(i){
            // Set the button that opens the modal
            var id =  i;
            var x = document.getElementsByClassName("suck");
            x[0].name = id;
        }
        // When the user clicks on the button, open the modal
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }



        }
    </script>

    <h1 class='store-header'>Best<span class = 'seller'>seller</span></h1>
    <section class="store">
        <?php

        $sql = 'Select * from store';
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['product_id'];
                $product = $row['product_name'];
                $product_descr = $row['product_descr'];
                $price_was = $row['product_price_was'];
                $price_is = $row['product_price_is'];
                $quantity = $row['quantity'];
                    echo "<div class = 'store-container'>";
                        
                        if($quantity>0){     
                            $filename = './images/store/product'.$id."*";
                            // glob -> function that searches for a specific file that we have partial name that we are looking for
                            $fileinfo = glob($filename);
                            // just for the first one
                            $fileExt = explode('.',$fileinfo[0]);
                            $fileactualExt = $fileExt[1]; //jpg not the name 
                            // echo "<img class='store-img' src = './images/store/product".$id.".".$fileactualExt."?".mt_rand()."'>";
                            // echo "<img class='store-img' src = './images/store/default.png'>";
                            echo "<img class='store-img' src = './images/store/product".$id.".png"."'>";

                        }else{
                            echo "<img class='store-img' src = './images/store/default.png'>";
                            echo '<h2 class="out-of-stock">This product is out of stock.</h2>';
                        }
                        echo '<h2 class="product-name">'.$product.'</h2>';
                        echo '<p class="prod-descr">'.$product_descr.'</p>';
                        if($price_was>$price_is){
                            echo "<div class = 'price-container'>";
                                echo '<h2 class="price-high">It was <br>$'.$price_was.'</h2>';
                                echo '<h2 class="price-low">For only <br>$'.$price_is.'</h2>';
                            echo "</div>"; 
                            $price = $price_was-$price_is;
                            echo '<p class="save">Save $'.$price.'</p>';
                        }else {
                            echo '<h2 class="price-low">For only <br>$'.$price_is.'</h2>';
                        }
                        if($quantity<=5){
                            echo '<h2 class="product-quantity nxito">Hurry up!</h2>';
                            echo '<h2 class="tot"><br>Only '.$quantity.' left.</h2>';
                        }
                        else {
                            echo '<h2 class="product-quantity">'.$quantity.' are in stock.</h2>';
                        }
                        $msg = "myModal";//Kjo e merr si funksion per te gjetur myModal
                        $style = 'block';
                        echo 
                        '<div class="buttons">';
                        ?>
                        <script>
                            function changeName(i){
                                // Set the button that opens the modal
                                var id =  i;
                                var x = document.getElementsByClassName("suck");
                                x[0].value = id;
                                alert(x[0].value);
                            }
                        </script>
                        <!-- ENd of php to start html as it was very difficult to implement onclick function cause of ' and " -->
                            <a href="javascript:;" class="buy" id="<?php echo $id;?>" 
                                onclick='document.getElementById("myModal").style.display = "block"; changeName("<?php echo $id;?>");'>
                                    <span><i class="far fa-money-bill-alt"></i></span> Buy now</a>
                            <br>
                            <br>
                            <a href="#" class="cart" onclick="popUp();"><span><i class="fas fa-shopping-cart"></i></span> Add to cart</a>
            <!-- Second php function to clos the previous div// -->
            <?php   
                        echo  '</div>';
                   echo "</div>"; 
                   
            }
        }else {
            echo 'We are sorry!<br> There are no products on stock.';
        }
    ?> 
    </section>

</body>
</html>