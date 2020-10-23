<?php
    session_start();
    include_once('dbh.inc.php');

    if(isset($_POST['payPal'])){
        //Get the product id which you wish to buy
        $prod_id = $_POST['product-id'];
        $cart = $_POST['card-number'];

        //validate card number 
        $visa = "/^4[0-9]{12}(?:[0-9]{3})?$/";
        if (preg_match($visa,$cart)){
            //checking the database for the requested product
            $sql = 'Select * from store where product_id='.$prod_id;
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $id = $row['product_id'];
                $product = $row['product_name'];
                $product_descr = $row['product_descr'];
                $price_was = $row['product_price_was'];
                $price_is = $row['product_price_is'];
                $quantity = $row['quantity'];
                $newQuantity = $quantity - 1;

                $update = "UPDATE store
                SET quantity = ".$newQuantity."
                WHERE product_id=".$prod_id.";";

                if($newQuantity>=0){
                    mysqli_query($conn,$update);
                }

                $timestamp = time();
                $out1 = 'OBTechnology Inovice'.PHP_EOL;
                $out2 = "o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o--o-o-o-o-o-o-o".PHP_EOL;
                $out3 = $_POST['name']." at: ".date("F d, Y h:i:s", $timestamp).PHP_EOL;
                $out4 = "o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o-o--o-o-o-o-o-o-o".PHP_EOL;
                $out5 = $id." ".$product." ".PHP_EOL;
                $out6 = $product_descr." ".PHP_EOL;
                $out7 = $price_is."$".PHP_EOL;
                $out8 = "Thank you!";
                $space = "".PHP_EOL;

                $dt1=date("Y-m-d");
                $sql2 = "INSERT INTO invoice(invoice_date,client_name,
                        client_email,inv_product_id,inv_price) VALUES (?,?,?,?,?);";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql2)){
                    echo "SQL error 2";
                }else{
                    echo 'inserting invoice info';
                    $zero = 0;
                    mysqli_stmt_bind_param($stmt,"sssss", $dt1,$_POST['name']
                                    ,$_POST['email'],$prod_id,$price_is);
                    mysqli_stmt_execute($stmt);
                }

                
                $file=fopen($_POST['name']." ".$_POST['email'].".txt",'a');//Shkrimi ne file...
                
                fwrite($file,$space);
                fwrite($file,$out1);
                fwrite($file,$out2);
                fwrite($file,$space);
                fwrite($file,$out3);
                fwrite($file,$space);
                fwrite($file,$out4);
                fwrite($file,$out5);
                fwrite($file,$out6);
                fwrite($file,$out7);
                fwrite($file,$space);
                fwrite($file,$out8);
                fwrite($file,$space);
                fclose($file);

                mysqli_close($conn);

                header('Location: ../shop.php?purchase=success');
            }else{
                echo 'Sorry.There are no products in stock';
            }
        }else{
            echo 'Your card number is not valid!';
        }
    }else{
        echo 'Server is not working right now.';
    }