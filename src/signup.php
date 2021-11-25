<?php
$connection = mysqli_connect("appdb", "user", "password", "appDB") or die(mysqli_error($connection));

if (isset($_POST['submit'])) 
{
    if (empty($_POST['login'])) 
    {
        $info_reg = 'Login is empty';
    }
    elseif (!preg_match("/^[a-zA-Z0-9_\.\-]{3,20}$/", $_POST['login'])) 
    {
        $info_reg = 'Login must be 3-20 characters long and contain latin letter, numbers, and signs "_", ".", "-"';
    }
    elseif (empty($_POST['password'])) 
    {
        $info_reg = 'Password is empty';
    }
    elseif (!preg_match("/^[a-zA-Z0-9_\.\-]{3,35}$/", $_POST['password'])) 
    {
        $info_reg = 'Password must be 3-35 characters long and contain latin letter, numbers, and signs "_", ".", "-"';
    }                      
    else 
    {
        $login = mysqli_real_escape_string($connection, $_POST['login']);              
        $password = mysqli_real_escape_string($connection, $_POST['password']);
  
        $query = "INSERT INTO `users` (login, password) VALUES ('$login', '$password')";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        
        header('Location: signin.php');
    }
}
?>

<html lang="ru" class="h-100">
<head>
  <meta charset="utf-8">
  <title>Bogged Stock Exchange | Sign up</title>
  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style>
    html,
    body {
      height: 100%;
    }

    body {
      display: flex;
      align-items: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }

    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: auto;
    }

    .form-signin .checkbox {
      font-weight: 400;
    }

    .form-signin .form-floating:focus-within {
      z-index: 2;
    }

    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
  </style>
</head>
<body class="text-center">
    
<main class="form-signin">
  <form action="signup.php" method="POST">
    <h1 class="h3 mb-3 fw-normal">Create a new account</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" maxlength="20" name="login" placeholder="login">
      <label for="floatingInput">Login</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" maxlength="35" name="password" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <?php
      $info_reg = isset($info_reg) ? $info_reg : NULL;
      if (isset($info_reg)) echo "<div class='alert alert-danger' role='alert'>{$info_reg}</div>";	  
    ?>
	<input class="w-100 btn btn-lg btn-primary" type="submit" value="Sign up" name="submit">
    <p class="mt-5 mb-3 text-muted">© Torusaynim, 2021</p>
  </form>
</main>
</body>
</html>