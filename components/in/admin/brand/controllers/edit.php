<?php
  session_start();

  require '../../../../config.php';
  require '../../../../db_config.php';

  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
  
  $res = array();

  isset($_POST['brandId']) ? $brandId = $_POST['brandId'] : exit("brandId is required!");
  isset($_POST['name']) ? $name = $_POST['name'] : exit("name is required!");

  $brandId = strip_tags(trim(mysqli_real_escape_string($connection,trim($brandId))));
  $name = strip_tags(trim(mysqli_real_escape_string($connection,trim($name))));
  
  $update = mysqli_query($connection, "UPDATE brands SET BrandName = '{$name}' WHERE BrandID = '$brandId'");

  if ($update) {
    $res['success'] = true;
  } else {
    $res['success'] = false;
  }

  echo json_encode($res);
?>