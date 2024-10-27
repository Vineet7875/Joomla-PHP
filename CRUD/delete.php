<?php
require '../Database/config.php';
$id=intval($_GET['id']);
$sql="delete from employees where id='$id';";
if($conn->query($sql))
{
    header("Location:../welcome.php");

}

?>