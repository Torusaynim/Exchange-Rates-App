<?php
session_start();

$connection = mysqli_connect("appdb", "user", "password", "appDB") or die(mysqli_error());

if (isset($_POST['buy']))
{
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
    else
    {
    $amount = $_POST['amount'];
    $data = mysqli_query($connection, "SELECT * FROM rates ORDER BY id DESC LIMIT 1");
    foreach ($data as $row)
    {
    $price = $row['price'];
    }
    $data = mysqli_query($connection, "SELECT * FROM users WHERE id={$_SESSION['id']}");
    foreach ($data as $row)
    {
    $balance = $row['balance'];
    $ebalance = $row['e-balance'];
    }
    if ($price * $amount > $balance)
    {
    $info_msg = 'You don&#039;t have enough money for that';
    }
    else
    {
    $balance = $balance - $amount*$price;
    $ebalance = $ebalance + $amount;
    mysqli_query($connection, "UPDATE users SET balance={$balance}, `e-balance`={$ebalance} WHERE id={$_SESSION['id']}") or die(mysqli_error($connection));
    }
    }
}
elseif (isset($_POST['sell']))
{
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
    else
    {
    $amount = $_POST['amount'];
    $data = mysqli_query($connection, "SELECT * FROM rates ORDER BY id DESC LIMIT 1");
    foreach ($data as $row)
    {
    $price = $row['price'];
    }
    $data = mysqli_query($connection, "SELECT * FROM users WHERE id={$_SESSION['id']}");
    foreach ($data as $row)
    {
    $balance = $row['balance'];
    $ebalance = $row['e-balance'];
    }
    if ($amount > $ebalance)
    {
    $info_msg = 'You don&#039;t have enough Vitalium for that';
    }
    else
    {
    $balance = $balance + $amount*$price;
    $ebalance = $ebalance - $amount;
    mysqli_query($connection, "UPDATE users SET balance={$balance}, `e-balance`={$ebalance} WHERE id={$_SESSION['id']}") or die(mysqli_error($connection));
    }
    }
}

?>

<!doctype html>
<html lang="ru" class="h-100">
<head>
  <!-- Meta tags -->
  <title>Bogged Crypto Exchange | Exchange Rates</title>
  <meta charset="utf-8">
  <!--auto refresh page every minute(not smooth)-->
  <meta http-equiv="refresh" content="60">
  <style>
    .chart-container {
      width: 100%;
      height: auto;
    }
    ::-webkit-scrollbar {
    width: 0;
    }
  </style>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="d-flex flex-column h-100">

<!-- Fixed navbar -->
<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html">Bogged Crypto Exchange</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" href="exchange.php">Exchange Rates</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled">Predictions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html">About</a>
          </li>
        </ul>
        <div class="text-end">
          <a class="btn btn-outline-light me-2" href="signin.php">Sign in</a>
          <a class="btn btn-primary" href="signup.php">Sign up</a>
        </div>
      </div>
    </div>
  </nav>
</header>

<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container" style="padding-top: 60px; padding-bottom: 60px">
    <h1 class="mt-5">VIT/RUB - Exchange rates for Vitalium</h1>
    <div class="chart-container">
      <canvas id="mycanvas"></canvas>
    </div>
    <h1 class="mt-3">Trading Menu</h1>
    <form action="exchange.php" method="POST">
      <div class="input-group" style="margin-top: 15px">
        <div class="input-group-prepend" style="margin-right: 4px">
          <span class="input-group-text" style="text-weight: bold">VIT</span>
        </div>
        <input type="number" class="form-control" name="amount" placeholder="Choose amount of Vitalium" aria-label="Choose amount of Vitalium" aria-describedby="basic-addon2">
        <div class="input-group-append" style="margin-left: 4px">
          <input class="btn btn-outline-success" type="submit" name="buy" value="Buy">
          <input class="btn btn-outline-danger" type="submit" name="sell" value="Sell">
        </div>
      </div>
    </form>
    <p class="lead" style="margin-top: 5px">
    <?php
    if (isset($_SESSION['id']))
    {
      $data = mysqli_query($connection, "SELECT * FROM users WHERE id={$_SESSION['id']}");
      foreach ($data as $row){
        echo "You have successfully logged in as <b>{$row['login']}#{$_SESSION['id']}</b>. Your current balance <b>RUB: {$row['balance']}</b>, amount of crypto <b>VIT: {$row['e-balance']}</b>";
      }
    }
    else echo "You haven't logged into system, please log into existing account or create a new account by pressing corresponding button at the navigation bar";
    
    $info_msg = isset($info_msg) ? $info_msg : NULL;
    if (isset($info_msg)) echo "<div class='alert alert-danger' role='alert'>{$info_msg}</div>";
    ?>
    </p>
    <a class="btn btn-outline-danger btn-lg w-100" href='signout.php'>Sign out</a>
  </div>
</main>

<!-- Footer -->
<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <span class="text-muted">Course work for the Development of server parts of Internet resources by Ivan "Torusaynim" Perlov</span>
  </div>
</footer>

<!-- javascript -->
<script type="text/javascript" src="chart/jquery.min.js"></script>
<script type="text/javascript" src="chart/Chart.min.js"></script>
<script type="text/javascript" src="chart/linegraph.js"></script>
</body>
</html>