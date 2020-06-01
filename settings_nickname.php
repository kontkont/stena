<details>
    <summary>Изменить никнейм</summary>

    <form action="" method="post">
        <input type="text" placeholder="Новый никнейм" name="changeNickname" required>
        <input type="submit" value="Изменить никнейм">
    </form>
</details>

<?php

include_once 'connection_stena.php';

include_once "function.php";

$newChangeNickname = $_POST['changeNickname'];
$loginChangeNickname = $_SESSION['login'];

if ($newChangeNickname)
{
    $connection->query("UPDATE users_stena 
                                     SET nickname ='$newChangeNickname' 
                                     WHERE login = '$loginChangeNickname';");

    header('Location: index.php');
}

?>
