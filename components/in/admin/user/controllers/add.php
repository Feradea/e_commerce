<?php
  session_start();

  require '../../../../config.php';
  require '../../../../db_config.php';

  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");

  $res = array();
  // check for required data
  isset($_POST['lastname']) ? $lastname = $_POST['lastname'] : exit('Lastname is required!');
  isset($_POST['email']) ? $email = $_POST['email'] : exit('Email is required!');
  isset($_POST['password']) ? $password = $_POST['password'] : exit('Password is required!');
  isset($_POST['password_again']) ? $password_again = $_POST['password_again'] : exit('Password confirm is required!');
  isset($_POST['role']) ? $role = $_POST['role'] : exit('Role is required!');

  $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;

  $firstname = strip_tags(trim(mysqli_real_escape_string($connection,trim($firstname))));
  $lastname = strip_tags(trim(mysqli_real_escape_string($connection,trim($lastname))));
  $email = strip_tags(trim(mysqli_real_escape_string($connection,trim($email))));
  $password = mysqli_real_escape_string($connection,trim($password));
  $password_again = mysqli_real_escape_string($connection,trim($password_again));

  if ($password !== $password_again)
    exit('Password do not match!');
  
  // check if user exists

  

  date_default_timezone_set('Europe/Belgrade');

  $reg_date = date('Y-m-d H:i:s');
  $ip = $_SERVER["REMOTE_ADDR"];

  $activation_state = 'Approved';

  $hash_salt_pass = password_hash($password, PASSWORD_DEFAULT);
  
  $user_newsletter = 0;
  $user_deactivation = 0; 

  $user = mysqli_query($connection, "SELECT * FROM users WHERE UserEmail = '{$email}'");
  if($user->num_rows > 0) {
    $res['exists'] = true;
  } else {
    $createUser = mysqli_query($connection, "INSERT INTO users(UserUserLevelID_FK, UserFirstName, UserLastName, UserEmail, UserPassword, UserRegistrationDate, UserNewsletter, UserDeactive, UserStatus) VALUES(
      '{$role}',
      '{$firstname}',
      '{$lastname}',
      '{$email}',
      '{$hash_salt_pass}',
      '{$reg_date}',
      '{$user_newsletter}',
      '{$user_deactivation}',
      '{$activation_state}'
    )") or die(mysqli_error($connection));
    if ($createUser) {
      $res['success'] = true;
    } else {
      $res['success'] = false;
    }
  }

  

  

  echo json_encode($res);
?>