<p>Регистрация:</p>
<form action="" method="post">
    <input type="text" placeholder="Логин" name="newLogin" required> <br>
    <p> <input type="text" placeholder="Никнейм" name="newNickname" > По умолчанию - 'Anonymous'</p> <br>
    <input type="text" placeholder="EMail" name="newMail" required> <br>
    <input type="password" placeholder="Пароль" name="newPassword" required>
    <input type="password" placeholder="Пароль еще раз" name="newPasswordTwo" required>
    <input type="submit" value="Зарегистрироваться">
</form>

<?php

include_once 'connection_stena.php';

include_once 'function.php';

$newLogin = htmlspecialchars($_POST['newLogin']);
$newPassword = htmlspecialchars($_POST['newPassword']);
$newPasswordTwo = htmlspecialchars($_POST['newPasswordTwo']);
$newNickname = htmlspecialchars($_POST['newNickname']);
$newMail = htmlspecialchars($_POST['newMail']);

$trueLoginReg = loginСheck($connection, $_POST, 'newLogin', 'users_stena', 'login');
$trueMailReg = loginСheck($connection, $_POST, 'newMail', 'users_stena', 'email');

if ($trueMailReg == FALSE && $trueLoginReg == FALSE && $newLogin)
{
    if ($newPassword == $newPasswordTwo)
    {
        $newUser = $connection->prepare("INSERT INTO users_stena
                                     SET login=:, nickname=:, password=:, email=:");
        $arrNewUser = ['login'=>$newLogin, 'nickname'=>$newNickname , 'password'=>$newPassword, 'email'=>$newMail];
        $newUser->execute($arrNewUser);
        $_SESSION['login'] = $newLogin;
        $_SESSION['password'] = $newPassword;
        echo 'Вы зарегистрировались. ';

        mail($newMail, 'Подтверждение регистрации по почте.', 'Настоящее подтверждение я не захотел сейчас делать.');
        echo "Письмо для подтверждения отправленно вам на почту - '$newMail'. <br> Проверьте спам.
              <br> Настоящее подтверждение по почте я сейчас еще не сделал, но письмо действительно приходит.";

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