<!--
<p>Registration:</p>
<form action="" method="post">
    <input type="text" placeholder="Login" name="login" required>
    <input type="text" placeholder="Password" name="password" required>
    <input type="submit" value="send">
</form>
-->

<?php

include("connection_stena.php");
$connection = new PDO("$bdInfo", "$bdUser", "$bdPass");

$newLogin=$_POST['login'];
$newPassword=$_POST['password'];

$allLogin = $connection->query("SELECT login FROM users_stena");
$allLogin = $allLogin->fetchAll(PDO::FETCH_COLUMN);

foreach ($allLogin as $log)
{
    if ($newLogin == $log && $_POST['login'])
    {
        echo 'Такой пользователь уже существует. ';
        include "authorization_form.php";
        $trueLogin = TRUE;
        exit;
    }
    elseif ($newLogin !== $log && $_POST['login'])
    {
        $trueLogin = FALSE;
    }
}


if ($trueLogin == FALSE && $_POST['login'])
{
    $connection->query("INSERT INTO users_stena (login, password) VALUE ('$newLogin','$newPassword')");
    echo 'Вы зарегистрировались';
}

?>