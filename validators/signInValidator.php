<?php

session_start();

if (!isset($_SESSION["id_user"])) {

    require "../components/functions.php";
    global $connection;

  
    if(!isset($_POST["token_login"]))
        message("false", "");

    $token = mysqli_real_escape_string($connection, $_POST["token_login"]);
    $token1 = $_POST["token_login"];
    $token2 = $_SESSION["token_login"];

    if (!password_verify($_SESSION["token_login"], $token)) 
        message("false", "token login: + $token + $token1 + $token2");
    

    $email = strip_tags(trim(mysqli_real_escape_string($connection, trim($_POST["signInInputEmail"]))));
    $password = mysqli_real_escape_string($connection, trim($_POST["signInInputPassword"]));

    if (empty($email)) {
        message("false", "Niste popunili email adresu.");
    }
    
    if (empty($password)) {
        message("false", "Niste popunili Lozinku.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        message("false", "Pogrešan Email format.");
    }

    $sql = "SELECT * FROM users
                WHERE UserEmail = '$email'
                AND UserDeactive = ''
                AND UserStatus = 'Approved'
                AND UserActivationKey = ''";
    $result = mysqli_query($connection, $sql);

    $data = [];

    if (mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_array($result, MYSQLI_BOTH)) {
            $data['user_id'] = (int) $record['UserID'];
            $data['user_fname'] = $record['UserFirstName'];
            $data['user_lname'] = $record['UserLastName'];
            $data['user_regpass'] = $record['UserPassword'];
            $data['user_regdate'] = $record['UserRegistrationDate'];
            $data['user_lvisit'] = $record['UserLastVisit'];
            $data['user_lip'] = $record['UserLastIP'];
            $data['user_newsletter'] = $record['UserNewsletter'];
        }

        if (password_verify($password, $data['user_regpass'])) {
            if (password_needs_rehash($data['user_regpass'], PASSWORD_DEFAULT)) {
                $new_hash_salt_pass = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET UserPassword='$new_hash_salt_pass' WHERE UserID='$user_id'";
                mysqli_query($connection, $sql);
            } 

            unset($_SESSION["token_login"], $_SESSION["token_reg"], $_SESSION["token_lost_pw"]);
            session_regenerate_id(true);
            $_SESSION["id_user"] = $data['user_id'];
            $_SESSION["user_name"] = $data['user_lname'] . " " . $data['user_fname'];
            $_SESSION["isAdmin"] = adminExists($data['user_id']);

            
            date_default_timezone_set("Europe/Belgrade");
            $last_visit = date("Y-m-d H:i:s");
            $last_ip = $_SERVER["REMOTE_ADDR"];

            $sql = "UPDATE users SET UserLastVisit = '$last_visit', UserLastIP = '$last_ip' WHERE UserID = '" . $_SESSION["id_user"] . "'";
            mysqli_query($connection, $sql);

            message("true", "");
        } 
        else {
            message("false", "Email adresa i/ili lozinka nisu validni.");
        }
    } 
    else 
    {
        message("false", "Email adresa i/ili lozinka nisu validni.");
    }
}
else{
    redirection("../index.php");
    // header("Location: ../index.php");
    exit();
}