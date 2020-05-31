<?php

session_start();
ini_set('session.gc.maxlifetime', +3600);

if (!$_SESSION['login'] && !$_SESSION['password'])
{
    include 'registration.php';
    include 'authorization.php';
}
elseif ($_SESSION['login'] && $_SESSION['password'])
{
    include 'profile.php';
    include 'comments.php';
}

?>
