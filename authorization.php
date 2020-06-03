<p>Авторизоваться:</p>
<form action="" method="post">
    <input type="text" placeholder="Логин" name="oldLogin" required>
    <input type="password" placeholder="Пароль" name="oldPassword" required>
    <input type="submit" value="Войти">
</form>

<?php

include_once 'connection_stena.php';

include_once 'function.php';

$oldLogin=htmlspecialchars($_POST['oldLogin']);
$oldPassword=htmlspecialchars($_POST['oldPassword']);

$trueLoginAuth = loginСheck($connection, $_POST, 'oldLogin', 'users_stena', 'login');
$truePassAuth = loginСheck($connection, $_POST, 'oldPassword', 'users_stena', 'password');

if ($trueLoginAuth == TRUE && $truePassAuth == TRUE)
{
    $_SESSION['login'] = $oldLogin;
    $_SESSION['password'] = $oldPassword;
    echo 'Авторизация прошла успешно. ';

    header('Location: index.php');
}
elseif ($trueLoginAuth !== TRUE && $truePassAuth == TRUE && $oldLogin)
{
    echo 'Неверный логин. ';
}
elseif ($trueLoginAuth !== TRUE && $truePassAuth !== TRUE && $oldLogin)
{
    echo 'Неверный логин. ';
}
elseif ($trueLoginAuth == TRUE && $truePassAuth !== TRUE && $oldLogin)
{
    echo 'Неверный пароль. ';
}

?>