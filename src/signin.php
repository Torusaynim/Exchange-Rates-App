<?php
session_start();


$connection = mysqli_connect("appdb", "user", "password", "appDB") or die(mysqli_error());

if (isset($_POST['submit'])) 
{
    if (empty($_POST['login'])) 
    {
        $info_input = 'Login is empty';
    }
    elseif (empty($_POST['password'])) 
    {
        $info_input = 'Password is empty';
    }
    else 
    {    
        $login = $_POST['login'];
        $password = $_POST['password'];            
        $user = mysqli_query($connection, "SELECT `id` FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
        $id_user = mysqli_fetch_array($user);
        
        if (empty($id_user['id'])) 
        {
            $info_input = 'Wrong login/password or this user doesn&#039;t exist';
        }
        else 
        {
            $_SESSION['password'] = $password; 
            $_SESSION['login'] = $login; 
            $_SESSION['id'] = $id_user['id']; 

            header('Location: index.html');         
        }     
    }
}
?>


<html lang="ru" class="h-100">
<head>
  <meta charset="utf-8">
  <title>Bogged Stock Exchange | Sign in</title>
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
  <form action="signin.php" method="POST">
    <h1 class="h3 mb-3 fw-normal">Sign in existing account</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" name="login" placeholder="login">
      <label for="floatingInput">Login</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <?php
      $info_input = isset($info_input) ? $info_input : NULL;
      if (isset($info_input)) echo "<div class='alert alert-danger' role='alert'>{$info_input}</div>";	  
    ?>
	<input class="w-100 btn btn-lg btn-primary" type="submit" value="Login" name="submit">
    <p class="mt-5 mb-3 text-muted">© Torusaynim, 2021</p>
  </form>
</main>
</body>
</html>