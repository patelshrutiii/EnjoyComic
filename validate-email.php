<?php
require_once "db.php";
?>
<?php

?>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>User Account Activation by Email Verification using PHP</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   </head>
   <body>
          <?php
            if($_GET['key'] && $_GET['token'])
            {
              $email = $_GET['key'];
              $_SESSION['UserEmail']=$email;
              
              $token = $_GET['token'];
              $_SESSION['UserToken']=$token;
              $query=$con->query("select * from usertbl where Code ='".$token."' and Email='".$email."'");
                if (mysqli_num_rows($query) > 0) {
                  $row= mysqli_fetch_array($query);
                   if($row['Vstatus'] == 0){
                    $del=$con->query("update usertbl set Vstatus=1 where  Email= '" . $email . "' and  Code = '".$token."' ");     
                     $msg = "Congratulations! Your email has been verified click done to go to the next page.";
                    //  header('location:thanks.php');

                   }else{
                      $msg = "You have already verified your account with us";
                   }
                } else {
                  $msg = "This email has been not registered with us";
                }
              }
              else
              {
              $msg = "Danger! Your something goes to wrong.";
            }
            ?>
      <div class="container mt-3">
          <div class="card">
            <div class="card-header text-center">
              User Account Activation by Email Verification 
            </div>
            <div class="card-body">
             <p><?php echo $msg; ?></p>
            </div>
            <div>
             <center> <a href="thanks.php"><button>Done</button></a></center>
          </div>
          </div>
      </div>

   </body>
</html>