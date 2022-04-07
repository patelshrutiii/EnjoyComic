
<?php
require_once "db.php";
include('smtp/PHPMailerAutoload.php');
?>

<h2 style="
    color: #29335c!important;
    line-height: 1.5!important;
    margin-top: 15px!important;
    font-size: 18px!important;
    font-family: Roboto-Regular,Arial,Helvetica,sans-serif!important;">It’s fun to share a good laugh, but did you know it can actually improve your health? </h2>
<h2 style=" 
    font-family: Source Serif Pro,Georgia,Times New Roman,Times,serif!important;
    font-weight: 400;
    line-height: 1.1;
    color: #3c6eb7;
    letter-spacing: 0;
    font-size: 1.75rem;">The benefits of laughter</h2>
    <p style="font-family: Roboto-Regular,Arial,Helvetica,sans-serif;
    font-size: 1.0625rem;
    margin-bottom: 1rem;
    font-size: inherit;
    line-height: 1.6;
    text-rendering: optimizeLegibility;">
      It’s true: laughter is strong medicine. It draws people together in ways that trigger healthy physical and emotional changes in the body. Laughter strengthens your immune system, boosts mood, diminishes pain, and protects you from the damaging effects of stress. Nothing works faster or more dependably to bring your mind and body back into balance than a good laugh. Humor lightens your burdens, inspires hope, connects you to others, and keeps you grounded, focused, and alert. It also helps you release anger and forgive sooner.</p>

      <p style="font-family: Roboto-Regular,Arial,Helvetica,sans-serif;
    font-size: 1.0625rem;
    margin-bottom: 1rem;
    font-size: inherit;
    line-height: 1.6;
    text-rendering: optimizeLegibility;
      ">
      With so much power to heal and renew, the ability to laugh easily and frequently is a tremendous resource for surmounting problems, enhancing your relationships, and supporting both physical and emotional health. Best of all, this priceless medicine is fun, free, and easy to use.</p>


      <h2 style="
    color: #29335c!important;
    line-height: 1.5!important;
    margin-top: 15px!important;
    font-size: 18px!important;
    font-family: Roboto-Regular,Arial,Helvetica,sans-serif!important;">Now you can enjoy reading new comics we sent every 5 minutes</h2>

</br>
</br>
</br>
</br>
    <center>
<a  style='background-color: white;
                        color: black;
                        border: 2px solid green;
                        padding: 10px 20px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;' href="index.php">Go Back To Home</a>
                        </center>
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
$selectmail = $con->query("select *from usertbl where Vstatus = 1 and Sstatus = 1 ");

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
                        <div>
                        <center>
                        <a style='background-color: white;
                        color: black;
                        border: 2px solid green;
                        padding: 10px 20px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;' href=' https://enjoycomic.herokuapp.com/unsubscribe.php?key=$UserMail'>Unsbscribe</a>
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
