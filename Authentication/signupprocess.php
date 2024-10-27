<?php
require '../Database/config.php';
session_start();

$name=trim($_POST['name']);
$email=trim($_POST['email']);
$password=trim($_POST['password']);

//when we redirect data getting cleared from input fields to persist those data use session and store it
$_SESSION['name']=$name;
$_SESSION['email']=$email;
$_SESSION['password']=$password;

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql="select * from authenticatedusers where email in ('$email')";
$result=$conn->query($sql);
if($result->num_rows)
{
    $_SESSION['emailvalidate']="Email Already used";
    header("Location:./signup.php");
    exit();
}


$sql1="insert into authenticatedusers (name,email,password) values 
('$name','$email','$hashed_password');";

if($conn->query($sql1))
{
    echo "user signup succes";
    // $_SESSION['signup_msg']="User Signup Succesful";
    setcookie('signup_msg','User Signup Succesful',time()+5);
    session_destroy();
    header("Location:Authentication/login.php");
}
else
{
    echo "error while user signup";
}




?>