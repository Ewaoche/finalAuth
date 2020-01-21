<?php 
require_once 'controller/auth.php';
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
        <div class="col-md-4 offet-md-4 form-div">
            <form action="login.php" method="post">
                <h3 class="text-center">Log In</h3>
                <?php if($errors): ?>
                <div class="alert alert-danger">
                    <?php foreach($errors as $error):?>
                    <li><?php echo $error; ?></li>
                    <?php endforeach; ?>                 
                </div>
               <?php endif; ?>
                <div class="form-group">
                    <label for="username">Email OR Username</label>
                    <input type="text" name="username" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name="password" class="form-control form-control-lg">
                </div>
              
                <button type="submit" name="login-btn" class="btn btn-primary btn-block btn-lg">Login In</button>
                <p class="text-center">Not a Member? <a href="signup.php">Register</a></p>
            </form>
        </div>
    </div>
</div>

   
   <link rel="stylesheet" href="js/jquery.js"> 
   <link rel="stylesheet" href="js/boostrap.min.js"> 
</body>
</html>