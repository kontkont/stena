<details>
    <summary>Востановление пароля</summary>

    <form action="" method="post">
        <input type="text" placeholder="Ваш логин" name="loginResetPassword" required>
        <input type="submit" value="Востановить пароль">
    </form>
</details>

<?php

include_once 'connection_stena.php';

include_once "function.php";

$loginResetPassword = htmlspecialchars($_POST['loginResetPassword']);
$checkResetLogin = loginСheck($connection, $_POST, 'loginResetPassword', 'users_stena', 'login');

if ($loginResetPassword && $checkResetLogin == TRUE)
{
    $resetPasswordMail = showKeyValue($connection, 'email','users_stena','login', $loginResetPassword);
    $oldPasswordReset = showKeyValue($connection, 'password','users_stena','login',$loginResetPassword);

    echo 'Пароль отправлен на ваш email. ';
    mail($resetPasswordMail,
        'Востановление пароля.',
        "Ваш пароль - '$oldPasswordReset'. ");

}
elseif ($loginResetPassword && $checkResetLogin == FALSE)
{
    echo 'Пользователя с таким логином не существует. ';
}

?>
