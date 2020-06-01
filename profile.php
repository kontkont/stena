<form method="POST">
    <input type="submit" name="unlogin" value="Выйти">
</form>

<?php

include_once 'connection_stena.php';

$searchLogin = $_SESSION['login'];

$profile = $connection->query("SELECT * FROM users_stena WHERE login = '$searchLogin';");
$profile = $profile->fetch();

$hmComments = $connection->query("SELECT COUNT(*) FROM comments_stena WHERE comm_login = '$searchLogin';");
$hmComments =$hmComments->fetch();

echo "id - {$profile['id']} <br> 
      Login - {$profile['login']} <br>
      Nickname - {$profile['nickname']} <br>
      EMail - {$profile['email']} <br>
      Password - {$profile['password']} <br>";
echo "Вы оставили комментариев - {$hmComments[0]} <br>";

if ($_POST['unlogin'])
{
    session_destroy();

    header('Location: index.php');
}

?>