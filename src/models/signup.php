<?php

function check(&$login, &$password)
{
$connection = mysqli_connect("appdb", "user", "password", "appDB") or die(mysqli_error($connection));

$info_msg = '';

if (empty($login)) 
{
  $info_msg = 'Login is empty';
}
elseif (!preg_match("/^[a-zA-Z0-9_\.\-]{3,20}$/", $login)) 
{
  $info_msg = 'Login must be 3-20 characters long and contain latin characters, numbers, and signs "_", ".", "-"';
}
elseif (empty($password)) 
{
  $info_msg = 'Password is empty';
}
elseif (!preg_match("/^[a-zA-Z0-9_\.\-]{3,35}$/", $password)) 
{
  $info_msg = 'Password must be 3-35 characters long and contain latin characters, numbers, and signs "_", ".", "-"';
}                      
else 
{
  $login = mysqli_real_escape_string($connection, $login);              
  $password = mysqli_real_escape_string($connection, $password);

  $query = "INSERT INTO `users` (login, password) VALUES ('$login', '$password')";
  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
}
return $info_msg;
}

?>
