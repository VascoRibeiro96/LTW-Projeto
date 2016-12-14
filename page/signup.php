<?php

include_once('../database/databaseInteraction.php');
include_once('../database/connection.php');

$name=$_POST['name'];
$username=$_POST['username'];
$email=$_POST['email'];
$gender=$_POST['gender'];
$password=$_POST['password'];
$passwordConfirmed=$_POST['passwordConfirm'];
$type=$_POST['type'];



if($name && $username && $email && $gender && $password && $passwordConfirmed){

  if($password!==$passwordConfirmed){
        include_once('register.php');
        echo 'Password confirmation does not match.';
        return;
  }

	$pass = password_hash($password, PASSWORD_DEFAULT);
	
  if(putUser($username,$pass,$name,$email,$gender, $type)==0){
    
	session_start();
	
	$userInfo = getUserInfo($username);
   
    $_SESSION['username'] = $username;
    $_SESSION['name'] = $userInfo['name'];

	header('Location: ../page/login.php');
  }
  else {
    echo 'Invalid account. Username already exists.';
    return;
  }
}
?>
