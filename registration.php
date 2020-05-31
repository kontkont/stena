<p>Регистрация:</p>
<form action="" method="post">
    <input type="text" placeholder="Логин" name="newLogin" required>
    <input type="text" placeholder="Пароль" name="newPassword" required>
    <input type="submit" value="Зарегистрироваться">
</form>

<?php

include_once 'connection_stena.php';

include_once 'function.php';

$newLogin= $_POST['newLogin'];
$newPassword=$_POST['newPassword'];

$trueLoginReg = loginСheck($connection, $_POST, 'newLogin', 'users_stena', 'login');

if ($trueLoginReg == FALSE && $newLogin)
{
    $connection->query("INSERT INTO users_stena (login, password) VALUE ('$newLogin','$newPassword')");
    $_SESSION['login'] = $newLogin;
    $_SESSION['password'] = $newPassword;
    echo 'Вы зарегистрировались. ';

    header('Location: index.php');
}
elseif ($trueLoginReg !== FALSE && $newLogin)
{
    echo "Логин '$newLogin' уже занят. ";
}

?>