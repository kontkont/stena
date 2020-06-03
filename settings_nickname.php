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

$newChangeNickname = htmlspecialchars($_POST['changeNickname']);
$loginChangeNickname = $_SESSION['login'];

if ($newChangeNickname)
{
    $makeChangeNickname = $connection->prepare("UPDATE users_stena 
                                     SET nickname =:nickname 
                                     WHERE login =:login;");
    $arrMakeChangeNickname = ['nickname'=>$newChangeNickname, 'login'=>$loginChangeNickname];
    $makeChangeNickname->execute($arrMakeChangeNickname);

    header('Location: index.php');
}

?>
