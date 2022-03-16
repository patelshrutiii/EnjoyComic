
<?php
require_once "db.php";
?>
<?php
             $email = $_GET['key'];
             
          
            $del=$con->query("update UserTbl set Sstatus=0 where email='".$email."' and Vstatus=1 ");  
            echo "<script>alert('you are sucessfully unsubscribe')</script>";        
              echo "<h1>thank you</h1>"
             
?>
<a  style='background-color: yellow;color:black;
                        padding: 14px 25px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;' href="index.php">Go To Login</a>