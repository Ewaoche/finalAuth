<?php require('controller/auth.php');

//verify user using token
if(isset($_GET['token'])){

    $token = $_GET['token'];
    verifyUser($token);


}


if(!isset($_SESSION['id'])){
header('Location: login.php');
exit();
}






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>finalAuth</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 ">
    <?php if(isset($_SESSION['message'])): ?>
        <div class="alert <?php echo  $_SESSION['alert-class'];?>">
        <?php echo $_SESSION['message'];
         unset($_SESSION['message']);
         unset($_SESSION['alert-class']);
        ?>"
        </div>
    <?php endif;?>

        <h3> You are Welcome  <?php echo $_SESSION['username'];?>"</h3>
        <a href="index.php?logout=1" class="logout">logout</a>

         <?php if(!$_SESSION['verified']):?>
         <div class="alert alert-warning">
            You need to verify your account.
            A message has been send to your email address  <strong> <?php echo $_SESSION['email'];?>"</strong> click on the link!
        </div>
       <?php endif;?>
        
        <?php if($_SESSION['verified']):?>
          <button class="btn btn-primary btn-block btn-lg">I Am Verified!!</button>
         <?php endif;?>
        </div>
    </div>
</div>

   <link rel="stylesheet" href="js/boostrap.min.js"> 
   <link rel="stylesheet" href="js/jquery.js"> 
</body>
</html>