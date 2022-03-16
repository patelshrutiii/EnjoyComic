
<?php
require_once "db.php";
include('smtp/PHPMailerAutoload.php');
?>
<h1>Now you can enjoy reading new comics we sent every 5 minutes</h1>
<a href="index.php">Go Back To Home</a>
<?php


$url = "https://c.xkcd.com/random/comic/";
$ch  = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$a = curl_exec($ch);
$url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
$str  = file_get_contents($url.'info.0.json');
$json = json_decode($str, true);
$imageTitle = $json['title'];
$imageUrl = $json['img'];
$imageAlt = $json['alt'];
$imageFile = file_get_contents($imageUrl);
$tokens = explode('/', $imageUrl);
$fileName = $tokens[(count($tokens) - 1)];
$ext = explode(".", $fileName);
$fileType = $ext[1];
$header = get_headers($imageUrl, true);
$fileSize = $header['Content-Length'];
$selectmail = $con->query("select *from UserTbl where vstatus = 1 and Sstatus = 1 ");

while($maildata=mysqli_fetch_array($selectmail))
{
$to = $maildata[1];
// echo $to;
$UserMail= $maildata[1];
$Utoken=$_SESSION['UserToken'];

try{
    
    
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
      $mail->Subject = "Enjoy reading today's most interesting XKCD comics";
      
      $mail->Body ="<html>
                    <head>
                    <title>Your email is listed in our comics subscribers.</title>
                    </head>
                    <body> 
                        <h1>$imageTitle</h1>
                        <img src=$imageUrl alt=$imageAlt>
                        <br>
                        <div style='height:50px;background-color: #ebebe0 ;'>
                        <center>
                        <a style='background-color: yellow;color:black;
                        padding: 14px 25px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;' href='https://enjoycomic.herokuapp.com/unsubscribe.php?key=$UserMail'>Unsbscribe</a>;
                        </center>
                        </div>
                    </body>
                    </html>";
    $mail->addStringAttachment(file_get_contents($imageUrl),$fileName);
      $mail->AddAddress($to);
      $mail->SMTPOptions=array('ssl'=>array(
          'verify_peer'=>false,
          'verify_peer_name'=>false,
          'allow_self_signed'=>false
      ));
      $mail->send();
    //   echo "sent";
      }catch (Exception $e){
      echo $mail->ErrorInfo;
  
       }


}
?>
