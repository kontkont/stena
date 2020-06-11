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
}

?>
