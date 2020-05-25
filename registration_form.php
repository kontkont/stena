<?php

$htmlRegistration = <<<HTML
<p>Registration:</p>
<form action="" method="post">
    <input type="text" placeholder="Login" name="login" required>
    <input type="text" placeholder="Password" name="password" required>
    <input type="submit" value="send">
</form>
HTML;

if ($_POST['login'] && $_POST['password'])
{
    //
}
elseif ($_POST['oldLogin'] && $_POST['oldPassword'])
{
    //
}
else
{
    echo $htmlRegistration;
}

include "registration.php";

?>