<?php

session_start();

function check_input(&$id, &$amount)
{

$info_msg = '';

if (!isset($_SESSION['id']))
{
  $info_msg = 'You didn&#039;t log in';
}
elseif (empty($_POST['amount'])) 
{
  $info_msg = 'Amount is empty';
}
elseif ($_POST['amount'] <= 0)
{
  $info_msg = 'Amount must be positive';
}
return $info_msg;
}

function check_buy(&$id, &$amount)
{
$connection = mysqli_connect("appdb", "user", "password", "appDB") or die(mysqli_error());
$data = mysqli_query($connection, "SELECT * FROM rates ORDER BY id DESC LIMIT 1");
foreach ($data as $row)
{
$price = $row['price'];
}
$data = mysqli_query($connection, "SELECT * FROM users WHERE id={$id}");
foreach ($data as $row)
{
$balance = $row['balance'];
$ebalance = $row['e-balance'];
}

$info_msg = '';

if ($price * $amount > $balance)
{
  $info_msg = 'You don&#039;t have enough money for that';
  return $info_msg;
}
else
{
  $balance = $balance - $amount*$price;
  $ebalance = $ebalance + $amount;
  mysqli_query($connection, "UPDATE users SET balance={$balance}, `e-balance`={$ebalance} WHERE id={$id}") or die(mysqli_error($connection));
}
return $info_msg;
}

function check_sell(&$id, &$amount)
{
$connection = mysqli_connect("appdb", "user", "password", "appDB") or die(mysqli_error());
$data = mysqli_query($connection, "SELECT * FROM rates ORDER BY id DESC LIMIT 1");
foreach ($data as $row)
{
$price = $row['price'];
}
$data = mysqli_query($connection, "SELECT * FROM users WHERE id={$id}");
foreach ($data as $row)
{
$balance = $row['balance'];
$ebalance = $row['e-balance'];
}

$info_msg = '';

if ($amount > $ebalance)
{
  $info_msg = 'You don&#039;t have enough Vitalium for that';
  return $info_msg;
}
else
{
  $balance = $balance + $amount*$price;
  $ebalance = $ebalance - $amount;
  mysqli_query($connection, "UPDATE users SET balance={$balance}, `e-balance`={$ebalance} WHERE id={$id}") or die(mysqli_error($connection));
}
return $info_msg;
}
