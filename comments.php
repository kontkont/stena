<p>Написать комментарий:</p>
<table><tr><td>
            <form action="" method="post">
                <input type="text" placeholder="Максимум 100 символов" name="comment_stena" required>
                <input type="submit" value="Отправить">
            </form>
        </td><td>
            <form action="" method="post">
                <input type="submit" name="update" value="Обновить">
            </form>
        </td></tr></table>

<?php

include_once 'connection_stena.php';

include_once "function.php";

$trueLoginComm = loginСheck($connection, $_SESSION, 'login', 'users_stena', 'login');
$truePassComm = loginСheck($connection, $_SESSION, 'password', 'users_stena', 'password');

if ($trueLoginComm == TRUE && $truePassComm == TRUE)
{
    comments($connection);

    if ($_POST['comment_stena'])
    {
        $oldLogin = $_SESSION['login'];
        $newComment = $_POST['comment_stena'];
        $connection->query("INSERT INTO comments_stena (comm_login, comment)
                                         VALUE ('$oldLogin','$newComment')");

        header('Location: index.php');
    }
}

if ($_POST['update'])
{
    header('Location: index.php');
}

?>



