<?php

session_start();
ini_set('session.gc.maxlifetime', +3600);

ob_start();

if ($_SESSION['login'] == 'admin')
{
    include 'adminka.php';
}

if (!$_SESSION['login'] && !$_SESSION['password'])
{
    include 'registration.php';
    include 'authorization.php';
    include 'authorization_reset_password.php';
}
elseif ($_SESSION['login'] && $_SESSION['password'])
{
    include 'profile.php';
    include 'settings_nickname.php';
    include 'settings_mail.php';
    include 'settings_password.php';
    include 'comments.php';

    if ($_SESSION['showStena'])
    {
        echo "<form method='post'>
              <input type='submit' value='Показать форум' name='showForum'>
              </form>";

        include 'comments.php';

        if ($_POST['showForum'])
        {
            unset ($_SESSION['showStena']);
            header('Location: index.php');
        }
    }
    else
    {
        echo "<form method='post'>
              <input type='submit' value='Показать стену комментариев' name='showStena'>
              </form>";

        include 'comments_forum.php';

        if ($_POST['showStena'])
        {
            $_SESSION['showStena'] = 'start';
            header('Location: index.php');
        }
    }
}

?>
