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

$info_input = isset($info_input) ? $info_input : NULL;
echo $info_input;

?>


<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Bogged Stock Exchange | Login</title>
</head>
<body>

<form action="login.php" method="POST" />
    <table>
        <tr>
            <td>Login:</td>
            <td><input type="text" name="login" /></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" /></td>
        </tr>
        <tr>
            <td colspan="2"><input class="button" type="submit" value="Login" name="submit" /></td> 
        </tr>
    </table>
</form>

</body>
</html>