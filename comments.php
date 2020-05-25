<?php

include("connection_stena.php");
$connection = new PDO("$bdInfo", "$bdUser", "$bdPass");

include "function.php";

$allLogin = $connection->query("SELECT * FROM users_stena");
$allLogin = $allLogin->fetchAll();

foreach ($allLogin as $log)
{
    if ($oldLogin == $log['login'] && $oldPassword == $log['password'])
    {
        echo 'а вот тут я ничего пока что не смог сделать без кукисов <br>
              по этому вы можете просто посмотреть тут комменты <br><br><br>';
        include "comments_form.php";

        if ($_POST['comment_stena'])
        {
            $oldLogin = $_POST['oldLogin'];
            $newComment = $_POST['comment_stena'];
            $connection->query("INSERT INTO comments_stena (comm_login, comment)
                                         VALUE ('$oldLogin','$newComment')");
        }

        comments($connection);
        exit;
    }
    elseif ($oldLogin !== $log && $oldPassword !== $log['password'])
    {
        //
    }
}

foreach ($allLogin as $log)
{
    if ($oldLogin == $log['login'] && $oldPassword == $log['password'])
    {
        $oldLogin = $_POST['oldLogin'];
        $newComment = $_POST['comment_stena'];
        $connection->query("INSERT INTO comments_stena (comm_login, comment)
                                         VALUE ('$oldLogin','$newComment')");
    }
}

?>



