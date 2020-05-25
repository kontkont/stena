<?php

$htmlAuthorization = <<<HTML
<p>Authorization:</p>
<form action="" method="post">
    <input type="text" placeholder="Login" name="oldLogin" required>
    <input type="text" placeholder="Password" name="oldPassword" required>
    <input type="submit" value="send">
</form>
HTML;

if ($_POST['oldLogin'] && $_POST['oldPassword'])
{
//
}
else
{
    echo $htmlAuthorization;
}

include "authorization.php";


?>