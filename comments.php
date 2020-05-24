<p>Post comment:</p>
<form action="" method="post">
    <input type="text" placeholder="max 100 symbols" name="comment_stena" required>
    <input type="submit" value="send">
</form>

<?php
include("connection_stena.php");
$connection = new PDO("$bdInfo", "$bdUser", "$bdPass");

if ($_POST['comment_stena']) {

    $newComment=$_POST['comment_stena'];
    $connection->query("INSERT INTO comments_stena (comment) VALUE ('$newComment')");

    $allComments = $connection->query("SELECT * FROM comments_stena");
    $allComments = $allComments->fetchAll();
    $allComments = array_reverse ($allComments);

    foreach ($allComments as $com)
    {
        echo $com['comment'] . '<br>';
    }
} else {
    $allComments = $connection->query("SELECT * FROM comments_stena");
    $allComments = $allComments->fetchAll();
    $allComments = array_reverse ($allComments);

    foreach ($allComments as $com)
    {
        echo $com['comment'] . '<br>';
    }
}
