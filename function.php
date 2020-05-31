<?php

function comments ($connection)
{
    $allComments = $connection->query("SELECT * FROM comments_stena");
    $allComments = $allComments->fetchAll();
    $allComments = array_reverse ($allComments);

    foreach ($allComments as $com)
    {
        echo "{$com['comm_login']} {$com['time']} № {$com['id']} <br> {$com['comment']} <br><br><br>";
        //echo "post by '{$com['comm_login']}' in {$com['time']}: <br> {$com['comment']} <br><br><br>";
    }
}

function loginСheck ($connection, $method, $postName, $table, $key)
{
    $newLogin = $method["$postName"];

    $allLogin = $connection->query("SELECT * FROM `$table` WHERE `$key` = '$newLogin'");
    $allLogin = $allLogin->fetch();
    $allLogin = $allLogin["$key"];

    if ($newLogin == $allLogin && $newLogin)
    {
        return TRUE;
    }
    elseif ($newLogin !== $allLogin && $newLogin)
    {
        return FALSE;
    }
}

?>