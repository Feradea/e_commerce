<?php
if(defined('SECRET') AND SECRET =='y0Y8KkBt37GDpDfVFp2NYdL8JnAqK5Z0')
{

    $connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

    if (mysqli_connect_errno())
        echo "Failed to connect to MySQL: " . mysqli_connect_error();

    mysqli_query($connection,"SET NAMES utf8") or die (mysqli_error($connection));
    mysqli_query($connection,"SET CHARACTER SET utf8") or die (mysqli_error($connection));
    mysqli_query($connection,"SET COLLATION_CONNECTION='utf8_general_ci'") or die (mysqli_error($connection));

}
?>