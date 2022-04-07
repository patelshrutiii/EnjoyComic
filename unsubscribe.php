
<?php
require_once "db.php";
?>
<?php
             $email = $_GET['key'];
             
          
            $del=$con->query("update usertbl set Sstatus=0 where Email='".$email."' and Vstatus=1 ");  
            echo "<script>alert('you are sucessfully unsubscribe')</script>";        
              
             
?>
<body>
  <center>
<h2 style=" 
    font-family: Source Serif Pro,Georgia,Times New Roman,Times,serif!important;
    font-weight: 400;
    line-height: 1.1;
    color: #3c6eb7;
    letter-spacing: 0;
    font-size: 1.75rem;">Thanks For Visit</h2>
<a  style='background-color: white;
                        color: black;
                        border: 2px solid green;
                        padding: 10px 20px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;' href="index.php">Go To Login</a>

</center>
              </body>