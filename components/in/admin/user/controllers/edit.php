<?php
  session_start();

  require '../../../../config.php';
  require '../../../../db_config.php';

  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");

  $res = array();
  // check for required data
  isset($_POST['userId']) ? $userId = $_POST['userId'] : exit("UserId is required!");
  isset($_POST['lastname']) ? $lastname = $_POST['lastname'] : exit('Lastname is required!');
  isset($_POST['password']) ? $password = $_POST['password'] : exit('Password is required!');
  isset($_POST['password_again']) ? $password_again = $_POST['password_again'] : exit('Password confirm is required!');
  isset($_POST['role']) ? $role = $_POST['role'] : exit('Role is required!');

  $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;

  $firstname = strip_tags(trim(mysqli_real_escape_string($connection,trim($firstname))));
  $lastname = strip_tags(trim(mysqli_real_escape_string($connection,trim($lastname))));
  $password = mysqli_real_escape_string($connection,trim($password));
  $password_again = mysqli_real_escape_string($connection,trim($password_again));

  if ($password !== $password_again)
    exit('Password do not match!');

  $updateUser = mysqli_query($connection, "UPDATE users SET UserFirstName = '{$firstname}', UserLastName = '{$lastname}', UserUserLevelID_FK = '{$role}' WHERE UserID = '$userId'");
  if ($password != "" && $password_again != "") {
    $hash_salt_pass = password_hash($password, PASSWORD_DEFAULT);
    $updateUser = mysqli_query($connection, "UPDATE users SET UserPassword = '{$hash_salt_pass}' WHERE UserID = '$userId'");
  }
  if ($updateUser) {
    $res['success'] = true;
  } else {
    $res['success'] = false;
  }

  echo json_encode($res);
?>