<?php

echo "<table border='2'><tr><td>";
echo "<form method='post'>
          <input type='checkbox' name='deleteLastComm' required>
          <input type='submit' value='Удалить последний комментарий'></form>";

echo "<form method='post'>
          <input type='checkbox' name='deleteIdComm' required>
          <input type='text' name='deleteIdCommText' placeholder='id' required>
          <input type='submit' value='Удалить комментарий по id'></form>";

if ($_SESSION['showError'])
{
    echo "<form method='post'>
              <input type='submit' value='Скрыть ошибки' name='stopShowError'>
              </form>";
}
else
{
    echo "<form method='post'>
              <input type='submit' value='Показать ошибки' name='showError'>
              </form>";
}

if ($_SESSION['showAuth'])
{
    echo "<form method='post'>
              <input type='submit' value='Скрыть блок авторизации' name='stopShowAuth'>
              </form>";
}
else
{
    echo "<form method='post'>
              <input type='submit' value='Показать блок авторизации' name='showAuth'>
              </form>";
}

echo "</td></tr></table>";

if ($_POST['deleteLastComm'])
{
    include_once 'connection_stena.php';

    $lastComment = $connection->query("SELECT * FROM comments_stena ORDER BY time DESC");
    $lastComment = $lastComment->fetch();
    $lastComment = $lastComment['id'];

    $connection->query("DELETE FROM comments_stena WHERE id = '$lastComment'");
    header('Location: index.php');
}

if ($_POST['deleteIdComm'])
{
    include_once 'connection_stena.php';

    $deleteIdComm = $_POST['deleteIdCommText'];
    $connection->query("DELETE FROM comments_stena WHERE id = '$deleteIdComm'");
    header('Location: index.php');
}

if ($_POST['showError'])
{
    $_SESSION['showError'] = 'start';
    header('Location: index.php');
}
elseif ($_POST['stopShowError'])
{
    unset ($_SESSION['showError']);
    header('Location: index.php');
}

if ($_SESSION['showError'])
{
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}

////////////////////////////////////////////////////////////////////////////////

if ($_POST['showAuth'])
{
    $_SESSION['showAuth'] = 'start';
    header('Location: index.php');
}
elseif ($_POST['stopShowAuth'])
{
    unset ($_SESSION['showAuth']);
    header('Location: index.php');
}

if ($_SESSION['showAuth'])
{
    include 'registration.php';
    include 'authorization.php';
    include 'authorization_reset_password.php';
}

?>