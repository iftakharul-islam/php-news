<?php
include "config.php";

if(isset($_FILES['fileToUpload'])){
  $errors=  [''];
  $fileName =   $_FILES['fileToUpload']['name'];
  $fileSize =   $_FILES['fileToUpload']['size'];
  $fileTmp =   $_FILES['fileToUpload']['tmp_name'];
  $fileTmp =   $_FILES['fileToUpload']['type'];
  $fileExt =  strtolower(end(explode('.',$fileExt)));
  $extension = array('jpeg','jpg','png');

  if(!in_array($fileExt,$extension)){
      $error[]= "This extension of file is not allowed, please chosse jpg, png, jpeg";
  }
  if($fileSize>2*(1024*1024)){
      $error[]="File size must less   or equal to 2MB";
  }
}


$title = mysqli_real_escape_string($conn,$_POST['post_title']);
$description = mysqli_real_escape_string($conn,$_POST['post_desc']);
$category = mysqli_real_escape_string($conn,$_POST['category']);
$date =date("d M,Y");
$auther = $_SESSION['user_id'];



?>