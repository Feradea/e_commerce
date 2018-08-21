<?php
  session_start();

  require '../../../../config.php';
  require '../../../../db_config.php';

  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
  
  $res = array();

  isset($_POST['productToDelete']) ? $productId = $_POST['productToDelete'] : exit('ProductID is required');

  $productId = strip_tags(trim(mysqli_real_escape_string($connection,trim($productId))));


  $delete = mysqli_query($connection, "DELETE FROM products WHERE ProductID = '$productId'");
  
  if ($delete) {
    $res['success'] = true;
  } else {
    $res['success'] = false;
  }

  echo json_encode($res);
?>