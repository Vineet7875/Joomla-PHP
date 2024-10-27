<?php
require '../Database/config.php';
session_start();

$name=$_POST['name'];
$email=$_POST['email'];
if(!isset($_GET['id'])) //no need for edit due to security purpose and one way encryption of data
{
    $password=$_POST['password'];
}

$department=$_POST['department'];
$designation=$_POST['designation'];


$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$id=$_POST['user_id'];
// echo $id;
if($id) //edit(update)
{
    // what if while editing already used email is used
    $sql1="select * from employees where id not in('$id') and email='$email'";
    $result = $conn->query($sql1);
    $noofrows = $result->num_rows;
    if($noofrows!=0)
    {
        $_SESSION['emailValidate']="Email Already Used";
        header("Location:./add_edit_employee.php?id=" . $id);
        exit();

    }

    $sql2 = "update employees set name='$name',email='$email',department='$department',designation='$designation' where id=$id";
    if($conn->query($sql2))
    {
        header("Location:../welcome.php");
    }
}
else //first time add
{
    
    $_SESSION['name']=$name;
    $_SESSION['email']=$email;
    $_SESSION['password']=$password;
    $_SESSION['department']=$department;
    $_SESSION['designation']=$designation;
    $sql4="select * from employees where email='$email';";
    $result = $conn->query($sql4);
    $noofrows = $result->num_rows;
    if($noofrows!=0)
    {
        $_SESSION['emailValidate']="Email Already Used";
        header("Location: ./add_edit_employee.php");
        exit();
    }

    $sql3 = "INSERT INTO employees (name, email, password, department, designation) VALUES ('$name', '$email', '$hashed_password','$department','$designation')";

    if($conn->query($sql3))
    {
        //we here not destroyed(it will destroy the all the sessions in the website sso its affecting our welcome page data of username) the session we have just done unset session variable 
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        unset($_SESSION['department']);
        unset($_SESSION['designation']); 


        header("Location:../welcome.php");
    }
}
?>