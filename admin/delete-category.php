<?php 
include "config.php";
$catId = $_GET['id'];

$sql = "DELETE FROM category WHERE category_id = {$catId}";
if(mysqli_query($conn,$sql)){
    header("Location:{$host}admin/category.php");
}else{
  echo "<p style='color:red;margin:10px;'> Can\'t Delete Cateogory record </p>";
}

?>