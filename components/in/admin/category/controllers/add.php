<?php
  session_start();

  require '../../../../config.php';
  require '../../../../db_config.php';

  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
  
  $res = array();

  isset($_POST['name']) ? $name = $_POST['name'] : exit("Name is required");

  $name = strip_tags(trim(mysqli_real_escape_string($connection,trim($name))));


  $insert = mysqli_query($connection, "INSERT INTO categories(CategoryName) VALUES('{$name}')");
  
  if ($insert) {
    $res['success'] = true;
  } else {
    $res['success'] = false;
  }

  echo json_encode($res);
?>