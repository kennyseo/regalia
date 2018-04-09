<?php
	$link = mysql_connect('localhost', 'bookstor', 'abc12345');
	if (!$link) die('Could not connect: ' . mysql_error());
	mysql_select_db("bookstor", $link);
?>
