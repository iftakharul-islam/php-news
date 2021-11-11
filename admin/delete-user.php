<?php 
include "config.php";
$userid = $_GET['id'];

$sql = "DELETE FROM user WHERE user_id = {$userid}";
if(mysqli_query($conn,$sql)){
    header("Location:{$host}admin/users.php");
}else{
  echo "<p style='color:red;margin:10px;'> Can\'t Delete user record </p>";
}

?>