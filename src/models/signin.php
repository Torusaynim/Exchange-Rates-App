<?php

function check(&$login, &$password)
{
session_start();

$connection = mysqli_connect("appdb", "user", "password", "appDB") or die(mysqli_error());

$info_msg = '';

if (empty($login)) 
{
  $info_msg = 'Login is empty';
}
elseif (empty($password)) 
{
  $info_msg = 'Password is empty';
}
else 
{    
  $login = mysqli_real_escape_string($connection, $login);
  $password = mysqli_real_escape_string($connection, $password);            
  $user = mysqli_query($connection, "SELECT `id` FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
  $id_user = mysqli_fetch_array($user);      

  if (empty($id_user['id'])) 
  {
  $info_msg = 'Wrong login/password or this user doesn&#039;t exist';
  }
  else 
  { 
  $_SESSION['id'] = $id_user['id'];        
  }     
}
return $info_msg;
}

?>
