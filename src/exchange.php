<!doctype html>
<html lang="ru" class="h-100">
<head>
  <!-- Meta tags -->
  <title>Bogged Crypto Exchange | Exchange Rates</title>
  <meta charset="utf-8">
  <style>
    .chart-container {
      width: 100%;
      height: auto;
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
  <div class="container" style="padding-top: 60px">
    <h1 class="mt-5">VIT/RUB - Exchange rates for Vitalium cryptocurrency</h1>
    <div class="chart-container">
      <canvas id="mycanvas"></canvas>
    </div>
	<p class="lead">
	  <?php
	    echo "Trading UI [temporary]";
	  ?>
	</p>
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