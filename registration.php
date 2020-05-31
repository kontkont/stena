<p>Регистрация:</p>
<form action="" method="post">
    <input type="text" placeholder="Логин" name="newLogin" required> <br>
    <input type="text" placeholder="Пароль" name="newPassword" required>
    <input type="text" placeholder="Пароль еще раз" name="newPasswordTwo" required>
    <input type="text" placeholder="EMail" name="newMail" required>
    <input type="submit" value="Зарегистрироваться">
</form>

<?php

include_once 'connection_stena.php';

include_once 'function.php';

$newLogin = $_POST['newLogin'];
$newPassword = $_POST['newPassword'];
$newPasswordTwo = $_POST['newPasswordTwo'];
$newMail = $_POST['newMail'];

$trueLoginReg = loginСheck($connection, $_POST, 'newLogin', 'users_stena', 'login');
$trueMailReg = loginСheck($connection, $_POST, 'newMail', 'users_stena', 'email');

if ($trueMailReg == FALSE && $trueLoginReg == FALSE && $newLogin)
{
    if ($newPassword == $newPasswordTwo)
    {
        $connection->query("INSERT INTO users_stena (login, password, email) 
                                 VALUE ('$newLogin','$newPassword','$newMail')");
        $_SESSION['login'] = $newLogin;
        $_SESSION['password'] = $newPassword;
        echo 'Вы зарегистрировались. ';

        header('Location: index.php');
    }
    elseif ($newPassword !== $newPasswordTwo)
    {
        echo 'Пароли не совпадают. ';
    }
}
elseif ($trueMailReg == TRUE && $newLogin)
{
    echo "Почта '$newMail' уже занята. ";
}
elseif ($trueLoginReg == TRUE && $newLogin)
{
    echo "Логин '$newLogin' уже занят. ";
}

?>