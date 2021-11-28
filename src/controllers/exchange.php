<?php

include '../models/exchange.php';

if (isset($_POST['buy']))
{
$info_msg = check_input($_SESSION['id'], $_POST['amount']);
if (empty($info_msg))
{
$info_msg = check_buy($_SESSION['id'], $_POST['amount']);
}
}
elseif (isset($_POST['sell']))
{
$info_msg = check_input($_SESSION['id'], $_POST['amount']);
if (empty($info_msg))
{
$info_msg = check_sell($_SESSION['id'], $_POST['amount']);
}
}
else
{
header('Location: ../exchange.php');
exit;
}

if (empty($info_msg))
{
header('Location: ../exchange.php');
exit;
}

echo $info_msg;

?>
