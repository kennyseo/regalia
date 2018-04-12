<?php
$link = mysqli_connect('localhost', 'root', 'root', 'bookstor');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
?>
