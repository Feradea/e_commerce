<?php
  session_start();

  require '../../../../config.php';
  require '../../../../db_config.php';

  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
  
  $res = array();

  isset($_POST['categoryId']) ? $categoryId = $_POST['categoryId'] : exit("categoryId is required!");
  isset($_POST['name']) ? $name = $_POST['name'] : exit("name is required!");

  $categoryId = strip_tags(trim(mysqli_real_escape_string($connection,trim($categoryId))));
  $name = strip_tags(trim(mysqli_real_escape_string($connection,trim($name))));
  
  $update = mysqli_query($connection, "UPDATE categories SET CategoryName = '{$name}' WHERE CategoryID = '$categoryId'");

  if ($update) {
    $res['success'] = true;
  } else {
    $res['success'] = false;
  }

  echo json_encode($res);
?>