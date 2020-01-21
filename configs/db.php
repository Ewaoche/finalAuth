<?php
require('constant.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 



// require_once '/path/to/vendor/autoload.php';

// // Create the Transport
// $transport = (new Swift_SmtpTransport('smtp.example.org', 25))
//   ->setUsername('your username')
//   ->setPassword('your password')
// ;

// // Create the Mailer using your created Transport
// $mailer = new Swift_Mailer($transport);

// // Create a message
// $message = (new Swift_Message('Wonderful Subject'))
//   ->setFrom(['john@doe.com' => 'John Doe'])
//   ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
//   ->setBody('Here is the message itself')
//   ;

// // Send the message
// $result = $mailer->send($message);



// // Sendmail
// $transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');