<p>Registration:</p>
<form action="" method="post">
    <input type="text" placeholder="Login" name="login" required>
    <input type="text" placeholder="Password" name="password" required>
    <input type="submit" value="send">
</form>

<?php
$connection = new PDO('mysql:host=localhost; dbname=a0263496_stena; charser=utf8',
    'dbname=a0263496_stena', '123');

$newLogin=$_POST['login'];
$newPassword=$_POST['password'];

$allLogin = $connection->query("SELECT * FROM users");
$allLogin = $allLogin->fetchAll();

foreach ($allLogin as $log) {
    if (empty($_POST['login'] )) {
        exit;
    } elseif ($newLogin==$log['login']) {
        echo 'Пользователь с таким логином уже существует';
        exit;
    } else {
        $connection->query("INSERT INTO users (login, password) VALUE ('$newLogin','$newPassword')");
        echo 'Вы зарегистрировались';
        exit;
    }
}