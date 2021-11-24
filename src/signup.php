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
        
        header('Location: login.php');
    }
}

$info_reg = isset($info_reg) ? $info_reg : NULL;
echo $info_reg;
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Bogged Stock Exchange | Registration</title>
</head>
<body>

<form action="signup.php" method="POST" />
    <table>
        <tr>
            <td>Login:</td>
            <td><input type="text" size="20" name="login" /></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" size="20" maxlength="35" name="password" /></td>
        </tr>
        <tr>
            <td colspan="2"><input class="button" type="submit" value="Register" name="submit" /></td>
        </tr>
    </table>
</form>

</body>
</html>