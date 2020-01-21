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
            <form action="signup.php" method="post">
                <h3 class="text-center">Registration</h3>
                <?php if($errors): ?>
                <div class="alert alert-danger">
                    <?php foreach($errors as $error):?>
                    <li><?php echo $error; ?></li>
                    <?php endforeach; ?>                 
                </div>
               <?php endif; ?>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" value ="<?php echo $username; ?>" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value ="<?php echo $email; ?>" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" value ="<?php echo $password; ?>" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="cpassword">Password Confirm</label>
                    <input type="password" name="cpassword" value ="<?php echo $cpassword; ?>" class="form-control form-control-lg">
                </div>
                <button type="submit" name="signup-btn" class="btn btn-primary btn-block btn-lg">Register</button>
                <p class="text-center">Already a Member? <a href="login.php">Sign In</a></p>
            </form>
        </div>
    </div>
</div>

   
   <link rel="stylesheet" href="js/jquery.js"> 
   <link rel="stylesheet" href="js/boostrap.min.js"> 
</body>
</html>