<?php
  session_start();

  require '../../../../config.php';
  require '../../../../db_config.php';

  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
  
  $res = array();

  isset($_POST['categoryToDelete']) ? $categoryId = $_POST['categoryToDelete'] : exit('categoryId is required');

  $categoryId = strip_tags(trim(mysqli_real_escape_string($connection,trim($categoryId))));


  $delete = mysqli_query($connection, "DELETE FROM categories WHERE CategoryID = '$categoryId'");
  
  if ($delete) {
    $res['success'] = true;
  } else {
    $res['success'] = false;
  }

  echo json_encode($res);
?>