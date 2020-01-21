<?php
require_once 'vendor/autoload.php';
require_once 'configs/constant.php';
// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465,'ssl'))
  ->setUsername('radicemmy@gmail.com')
  ->setPassword('ewaoche@?12345');


// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);



function sendVerificationEmail($userEmail, $token){
    global $mailer;
 
 $body = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Email</title>
</head>
<body>
    <div class="wrapper">
    <p>
      Thank you for visiting my website, please kindly follow the link to verify 
      your email 
    </p>
    <a href="http://localhost/finalAuth/index.php?token='. $token .' ">Verify your email address</a>
    </div>
</body>
</html>';

// Create a message
$message = (new Swift_Message('Verify your email address'))

->setFrom(['radicemmy@gmail.com' => 'emmy'])
->setTo($userEmail)
->setBody($body, 'text/html')
; 

// Send the message
$result = $mailer->send($message);
if($result){
  echo "Mail sent successfuly";
}else{
  echo "Mail failed to send";
}

}
