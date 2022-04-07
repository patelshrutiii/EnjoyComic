

<?php
require_once "db.php";
?>
<?php
include('smtp/PHPMailerAutoload.php');


if(isset($_REQUEST['DataBtn']))
{
    
    $check=$con->query("select * from usertbl where Email like '$_REQUEST[email]'");
    $checkrow=mysqli_fetch_array($check);
    if($checkrow[0] == "")
    {
        $token = md5($_REQUEST['email']).rand(10,99);

        $in=$con->query("insert into usertbl values(0,'$_REQUEST[email]', '" . $token . "',0,1)");
        try{
           
         $link = "<a href=' https://enjoycomic.herokuapp.com/validate-email.php?key=".$_REQUEST['email']."&token=".$token."'>Click and Verify Email</a>";
       
          $reci=$_REQUEST['email'];
          $msg= 'Click On This Link to Verify Email';
            $mail = new PHPMailer(); 
            $mail->SMTPDebug  = 0;
            $mail->IsSMTP(); 
            $mail->SMTPAuth = true; 
            $mail->SMTPSecure = 'tls'; 
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587; 
            $mail->IsHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Username = "patelshruti.200188@gmail.com";
            $mail->Password = "shruti@2001";
            $mail->SetFrom("patelshruti.200188@gmail.com");
            $mail->Subject = "Email Varification";
            // $mail->Body = $msg.$link;
            $mail->Body ="<html>
                           <head>
                           <title>Rtcamp Php Assignment</title>
                           </head>
                            <body >
                             <center><h1>Please Varify Your Gmail Account</h1>
                            <div style=' background-color: white;
                            color: black;
                            border: 2px solid green;
                            padding: 10px 20px;
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;'>
                             <a> Click On This Link to Verify Email $link</a>
                             </div>
                             </center>
                            </body>
                        
                            </html>";
            $mail->AddAddress($reci);
            $mail->SMTPOptions=array('ssl'=>array(
                'verify_peer'=>false,
                'verify_peer_name'=>false,
                'allow_self_signed'=>false
            ));
            $mail->send();
            echo "<script>alert('Varification link  is sent to your gmail account Please varify your gmail')</script>";  
        }catch (Exception $e){
            echo $mail->ErrorInfo;
        
        }
           
        
    }
    else
    {
         echo "You have already registered with us. Check Your email box and verify email.";
    }
}
?>
