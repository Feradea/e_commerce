<?php
  session_start();

  require '../../../../config.php';
  require '../../../../db_config.php';

  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
  
  $res = array();

  isset($_POST['userToDelete']) ? $userId = $_POST['userToDelete'] : exit('UserID is required');

  $userId = strip_tags(trim(mysqli_real_escape_string($connection,trim($userId))));

  if ($_SESSION['id_user'] === $userId) {
    exit("You cannot delete yourself!");
  }

  $delete = mysqli_query($connection, "DELETE FROM users WHERE UserID = '$userId'");
  
  if ($delete) {
    $res['success'] = true;
  } else {
    $res['success'] = false;
  }

  echo json_encode($res);
?>