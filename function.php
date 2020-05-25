<?php

/*
function searchKeyValue ($value, $array, $array_key)
{
    foreach ($array as $arr) {
        if ($value == $arr["'$array_key'"])
        {
            //значение найдено
            return TRUE;
            exit;
        }
        elseif ($value !== $arr["'$array_key'"])
        {
            //значение не найдено
            return NULL;
        }
    }
}
*/

function comments ($connection)
{
    $allComments = $connection->query("SELECT * FROM comments_stena");
    $allComments = $allComments->fetchAll();
    $allComments = array_reverse ($allComments);

    foreach ($allComments as $com)
    {
        echo "post by '{$com['comm_login']}' in {$com['time']}: <br> {$com['comment']} <br><br><br>";
    }
}

?>