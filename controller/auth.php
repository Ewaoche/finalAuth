<?php
session_start();
$errors = array();
$username = '';
$email = '';
$password = '';
$cpassword = '';
//sign up
if(isset($_POST['signup-btn'])){
    require('configs/db.php');
    require_once 'emailController.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    //validations
    if(empty($username)){
       $errors['username'] = "username is required";
    }
    if(empty($email)){
       $errors['email'] = "email is required";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['invalid-email'] = "Valid email is required";
    }
    if(empty($password)){
       $errors['password'] = "password is required";
    }
    if(empty($cpassword)){
       $errors['cpassword'] = "password confirmation is required";
    }
    if(($password !== $cpassword)){
       $errors['confirm'] = "The two password  is not matched";
    }

    //validate duplicate email
    $sql = " SELECT * FROM users WHERE email = ? ";
   
    $stmt = $conn->prepare($sql);
    echo $conn->error;
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->num_rows;
    if($count > 0){
        $errors['duplicate-email'] = "User this email already exist";
    }

    // no error
    if(count($errors) === 0){
        $enpassword = password_hash($password, PASSWORD_DEFAULT);
         $token = bin2hex(random_bytes(50));
         $verified = false;
         
         $insert = "INSERT INTO users(username, email, verified, token, password) VALUES(?, ?, ?, ?, ?)";
         $stmt = $conn->prepare($insert);
         $stmt->bind_param('ssbss', $username, $email, $verified, $token, $enpassword);
        
         if($stmt->execute()){         
           $user_id = $conn->insert_id;
           $_SESSION['id'] = $user_id;
           $_SESSION['username'] = $username;
           $_SESSION['email'] = $email;
           $_SESSION['verified'] = $verified;

           sendVerificationEmail( $email, $token);
           //set flash message
           $_SESSION['message'] = 'You are now logged In';
           $_SESSION['alert-class'] = 'alert-success';
           header('Location: index.php');
           exit();
         }

         else{
            $errors['db-error'] = "Database error occured!";
         }
        }
    }

    //sign in
if(isset($_POST['login-btn'])){
   require('configs/db.php');

   $username = $_POST['username'];
   $password = $_POST['password'];

   //validations
   if(empty($username)){
      $errors['username'] = "username  or email is required";
   }
  
   if(empty($password)){
      $errors['password'] = "password is required";
   }

   //if no error
  if(count($errors)===0){
   $sql = "SELECT * FROM users WHERE email = ? OR username = ? LIMIT 1";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param('ss', $username, $username);
   $stmt->execute();
   $result = $stmt->get_result();
   $user = $result->fetch_assoc();
   if(password_verify($password, $user['password'])){
     // logIn  user
     $_SESSION['id'] =  $user['id'];
     $_SESSION['username'] = $user['username'];
     $_SESSION['email'] = $user['email'];
     $_SESSION['verified'] = $user['verified'];

     //set flash message
     $_SESSION['message'] = 'You are now logged In';
     $_SESSION['alert-class'] = 'alert-success';
     header('Location: index.php');
     exit();
   }else{ 
      $errors['invalid-password'] = "Invalid password";
   }

  }
  
   }
  
   //logout user
   if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['verified']);
    header('Location:login.php');
    exit();
   }

   // verifyUser 
   function verifyUser($token){
   global $conn;

   $sql = "SELECT * FROM users WHERE token = '$token' LIMIT 1";
   $result = mysqli_query($conn, $sql);
   if(mysqli_num_rows($result) > 0){
   $user = mysqli_fetch_assoc($result);
   $update_query = "UPDATE users SET verified = 1 WHERE token = '$token'";

   if(mysqli_query($conn, $update_query)){
  
  // log in user
  $_SESSION['id'] =  $user['id'];
  $_SESSION['username'] = $user['username'];
  $_SESSION['email'] = $user['email'];
  $_SESSION['verified'] = 1;
  //set flash message
  $_SESSION['message'] = 'your email is successfully verified !';
  $_SESSION['alert-class'] = 'alert-success';
  header('Location: index.php');
  exit();

   }else{
      echo 'user no found';
   }

   }

   }
