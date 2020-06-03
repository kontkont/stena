<details>
    <summary>Изменить почту</summary>

    <form action="" method="post">
        <input type="text" placeholder="Новая почта" name="changeMailOne" required>
        <input type="text" placeholder="Новая почта еще раз" name="changeMailTwo" required>
        <input type="submit" value="Изменить почту">
    </form>
</details>

<?php

include_once 'connection_stena.php';

include_once "function.php";

if ($_POST['changeMailOne'] && $_POST['changeMailOne'] == $_POST['changeMailTwo'])
{
    $toMail = htmlspecialchars($_POST['changeMailOne']);
    mail($toMail, 'Подтверждение смены почты.', 'Настоящее подтверждение я не захотел сейчас делать.');
    echo "Письмо для подтверждения отправленно вам на НОВУЮ почту - '$toMail'. <br> Проверьте спам.
    <br> Настоящее подтверждение по почте я сейчас еще не сделал, но письмо действительно приходит.";

    $newChangeMail = htmlspecialchars($_POST['changeMailOne']);
    $loginChangeMail = $_SESSION['login'];
    $makeChangeMail = $connection->prepare("UPDATE users_stena 
                                 SET email =:email 
                                 WHERE login =:login;");
    $arrMakeChangeMail = ['email'=>$newChangeMail, 'login'=>$loginChangeMail];
    $makeChangeMail->execute($arrMakeChangeMail);
}
elseif ($_POST['changeMailOne'] && $_POST['changeMailOne'] !== $_POST['changeMailTwo'])
{
    echo 'Указанные НОВЫЕ почты не совпадают. ';
}

?>