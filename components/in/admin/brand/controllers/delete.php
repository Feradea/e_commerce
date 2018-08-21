<?php
  session_start();

  require '../../../../config.php';
  require '../../../../db_config.php';

  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
  
  $res = array();

  isset($_POST['brandToDelete']) ? $brandId = $_POST['brandToDelete'] : exit('brandId is required');

  $brandId = strip_tags(trim(mysqli_real_escape_string($connection,trim($brandId))));


  $delete = mysqli_query($connection, "DELETE FROM brands WHERE BrandId = '$brandId'");
  
  if ($delete) {
    $res['success'] = true;
  } else {
    $res['success'] = false;
  }

  echo json_encode($res);
?>