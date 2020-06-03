<details>
    <summary>Изменить пароль</summary>

    <form action="" method="post">
        <input type="password" placeholder="Старый пароль" name="oldChangePassword" required>
        <input type="password" placeholder="Новый пароль" name="changePasswordOne" required>
        <input type="password" placeholder="Новый пароль еще раз" name="changePasswordTwo" required>
        <input type="submit" value="Изменить пароль">
    </form>
</details>

<?php

include_once 'connection_stena.php';

include_once "function.php";

$newChangePassword = $_POST['changePasswordOne'];
$oldChangeLogin = $_SESSION['login'];

if ($_POST['oldChangePassword'] && $_SESSION['password'] == $_POST['oldChangePassword'])
{
    if ($_POST['changePasswordOne'] == $_POST['changePasswordTwo'])
    {
        $makeChangePassword = $connection->prepare("UPDATE users_stena 
                                     SET password =:password
                                     WHERE login =:login;");
        $arrMakeChangePassword = ['password'=>$newChangePassword, 'login'=>$oldChangeLogin];
        $makeChangePassword->execute($arrMakeChangePassword);

        session_destroy();
        header('Location: index.php');
    }
    elseif ($_POST['changePasswordOne'] !== $_POST['changePasswordTwo'])
    {
        echo 'Указанные НОВЫЕ пароли не совпадают. ';
    }
}
elseif ($_POST['oldChangePassword'] && $_SESSION['password'] !== $_POST['oldChangePassword'])
{
    echo 'Cтарый пароль неверен. ';
}

?>
