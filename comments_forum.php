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

//Подключение к бд
include_once 'connection_stena.php';

//Подключение функций
include_once "function.php";

//Проверка через функцию существует ли такой логин и пароль
$trueLoginComm = loginСheck($connection, $_SESSION, 'login', 'users_stena', 'login');
$truePassComm = loginСheck($connection, $_SESSION, 'password', 'users_stena', 'password');

//Если логин и пароль существуют
if ($trueLoginComm == TRUE && $truePassComm == TRUE)
{
    //Выводятся все посты если id_op пустое, сортируются по времени от последнего к первому
    $allComments = $connection->query("SELECT * FROM comments_stena WHERE id_op IS NULL ORDER BY time DESC");
    $allComments = $allComments->fetchAll();

    //Перебираем все посты
    foreach ($allComments as $com)
    {
        ?><table border="1"><tr><td><?php
                ?><table border="1"><tr><td><?php

                            //Выводим пост и форму ответа
                            echo "{$com['comm_nickname']} {$com['time']} № {$com['id']} <br> {$com['comment']} <br>
                          <form method='post'>
                <input type='text' placeholder='Максимум 100 символов' name='subcomment_stena' required>
                
                <!-- Вот тут костыль, скрытое поле которое несет в значении id поста, запомни это -->
                <input type='hidden' name='forSubComment' value='{$com['id']}' required>
                <input type='submit' value='Ответить'>
            </form>  <br><br><br>";

                            ?></td></tr></table><?php

                //Выводится комменты к посту чье id равно id_op
                $subComments = $connection->query("SELECT * FROM comments_stena WHERE id_op = '{$com['id']}'");

                //Внутри форича с постами делаем форич для перебора комментов к посту
                foreach ($subComments as $subcom)
                {
                    ?><table border="1"><tr><td><?php

                            //Выводим коммент к посту
                            echo "{$subcom['comm_nickname']} {$subcom['time']} № {$subcom['id']} <br>
                   >>{$com['id']}(OP) <br> {$subcom['comment']} <br>";

                            //Тут внутри самого цикла логика создания комментато
                            //Это нужно что бы записать id поста в id_op комментария
                            if ($_POST['subcomment_stena'])
                            {
                                //Делаем переменную с логином, вытаскиваем из сессии
                                $oldLogin = $_SESSION['login'];

                                //Переменная с комментарием
                                $newComment = htmlspecialchars($_POST['subcomment_stena']);

                                //Вот тут создаем переменную из скрытого поля, в значении у нас id поста
                                $opCommentId = $_POST['forSubComment'];

                                //Переменная с ником
                                $oldNickname = showKeyValue($connection, 'nickname', 'users_stena', 'login', $oldLogin);

                                //Записываем комментарий в бд, в id_op записывается id материнского поста
                                $makeComment = $connection->prepare("INSERT INTO comments_stena 
                                     SET comm_login = :comm_login, 
                                         comm_nickname = '$oldNickname', 
                                         comment = :comment,
                                         id_op = '$opCommentId'");
                                $arrMakeComment = ['comm_login'=>$oldLogin, 'comment'=>$newComment];
                                $makeComment->execute($arrMakeComment);

                                header('Location: index.php');

                                //Остановить цикл нужно обязательно, иначе создастся несколько одинаковых комментариев
                                exit;
                            }

                            ?></td></tr></table><?php
                }
                ?></td></tr></table><br><?php
    }

    //Тут отдельно вынесена логика создания поста, она такая же как и у комментария за очевидными отличаями
    if ($_POST['comment_stena'])
    {
        $oldLogin = $_SESSION['login'];
        $newComment = htmlspecialchars($_POST['comment_stena']);

        $oldNickname = showKeyValue($connection, 'nickname', 'users_stena', 'login', $oldLogin);

        $makeComment = $connection->prepare("INSERT INTO comments_stena 
                                     SET comm_login = :comm_login, 
                                         comm_nickname = '$oldNickname', 
                                         comment = :comment");
        $arrMakeComment = ['comm_login'=>$oldLogin, 'comment'=>$newComment];
        $makeComment->execute($arrMakeComment);

        header('Location: index.php');
    }
}

//Для кнопки обновления
if ($_POST['update'])
{
    header('Location: index.php');
}

?>
