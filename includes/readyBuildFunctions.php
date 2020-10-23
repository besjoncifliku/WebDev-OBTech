<?php
    include_once 'includes/dbh.inc.php';
    
    function displayProfileImage($id){
        $sql = 'Select * from users';
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                // $id = $row['id'];
                $uname = $row['username'];
                $sqlImage = 'select * from profile_image where userid ='.$id;
                $resultImg = mysqli_query($conn,$sqlImage);
                while($rowImg = mysqli_fetch_assoc($resultImg)){
                    echo "<div class = 'user-container'>";
                        
                        if($rowImg['status'] == 1){     
                            $filename = 'uploads/profile'.$id."*";
                            // glob -> function that searches for a specific file that we have partial name that we are looking for
                            $fileinfo = glob($filename);
                            // just for the first one
                            $fileExt = explode('.',$fileinfo[0]);
                            $fileactualExt = $fileExt[1]; //jpg not the name 
                            echo "<img class='profileImage' src = 'uploads/profile".$id.".".$fileactualExt."?".mt_rand()."'>";
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
    }
?>