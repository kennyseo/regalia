<?php
$user = 'root';
$password = 'root';
$db = 'bookstor';
$host = 'localhost';
$port = 8889;

$link = mysqli_init();
$success = mysqli_real_connect(
   $link,
   $host,
   $user,
   $password,
   $db,
   $port
);

/*
  $link = mysql_connect('helix.uark.edu', 'bookstor', 'hearted_set_incase');
	if (!$link) die('Could not connect: ' . mysql_error());
	mysql_select_db("bookstor", $link);
  */
?>
