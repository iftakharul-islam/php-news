<?php 
include "config.php";
if(!$_SESSION['user_role']==1){
  header("Location:{$host}admin/post.php");
}
else if(!$_GET['id']){
  header("Location:{$host}admin/category.php");
}
$catId = $_GET['id'];

$sql = "DELETE FROM category WHERE category_id = {$catId}";
if(mysqli_query($conn,$sql)){
    header("Location:{$host}admin/category.php");
}else{
  echo "<p style='color:red;margin:10px;'> Can\'t Delete Cateogory record </p>";
}

?>