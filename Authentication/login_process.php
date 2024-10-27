<?php
require '../Database/config.php';
session_start();

$email=trim($_POST['email']);
$password=trim($_POST['password']);

$_SESSION['email']=$email;
$_SESSION['password']=$password;

$sql1="select * from authenticatedusers where email in ('$email')";
$result=$conn->query($sql1);
if($result->num_rows)
{
    $sql2="select password from authenticatedusers where email='$email'";
    $result1=$conn->query($sql2);
    $dbpassword=$result1->fetch_assoc();
    if(!password_verify($password,$dbpassword['password']))
    {
        $_SESSION['passvalidate']="Incorrect password";
        header("Location:./login.php");
        exit();
    }
    else
    {
        echo "user login succes";
        session_destroy();
        session_start();

        //retrieving id so we can retrieve a name and display on welcome page
        $sql3="select * from authenticatedusers where email='$email'";
        $result2=$conn->query($sql3);
        $userdata=$result2->fetch_assoc();
        $_SESSION['username']=$userdata['name'];
        header("Location:../welcome.php");
    }
}
else
{
    $_SESSION['emailvalidate']="Incorrect Email";
    header("Location:./login.php");
    exit();

}





?>