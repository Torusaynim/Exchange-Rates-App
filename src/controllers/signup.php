<?php

include '../models/signup.php';

if (isset($_POST['submit'])) 
{
$info_msg = check($_POST['login'], $_POST['password']);
}
else
{
header('Location: ../signup.html');
exit;
}

if (empty($info_msg))
{
header('Location: ../signin.html');
exit;
}

echo $info_msg;

?>
