<?php

include '../models/signin.php';

if (isset($_POST['submit'])) 
{
$info_msg = check($_POST['login'], $_POST['password']);
}
else
{
header('Location: ../signin.html');
exit;
}

if (empty($info_msg))
{
header('Location: ../exchange.php');
exit;
}

echo $info_msg;

?>
