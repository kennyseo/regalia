<?php
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
	header("Pragma: no-cache");
	//require_once("./ldap/session.php");

	include("includes/header.php");
	include("includes/nav.php");
	include("includes/connection.php");

?>
<div class="container">

</div> 	
<center>

<!-- <form action="index.php" method="GET" > -->
<p><a href="http://uofastore.com/graduation/faculty.php">Faculty Website</a></p>
<div>
	<? include("classes/faculty.php"); ?>
</div>
<p>&nbsp;</p>
<hr>


<div>
	<h2>&emsp;STUDENT REGALIA</h2>
	<? include("includes/nav_students.php"); ?>
		<div>
			<p><a href="http://uofastore.com/graduation/student.php">Student Website</a></p>
			<? include("classes/student.php"); ?>
		</div>
</div>


</center>


	<p>&nbsp;</p>


	<!-- </form>	-->


</div>
</div>

?>
<center>

<!-- <form action="index.php" method="GET" > -->
<p><a href="http://uofastore.com/graduation/faculty.php">Faculty Website</a></p>
<div>
	<? include("classes/faculty.php"); ?>
</div>
<p>&nbsp;</p>
<hr>


<div>
	<h2>&emsp;STUDENT REGALIA</h2>
	<? include("includes/nav_students.php"); ?>
		<div>
			<p><a href="http://uofastore.com/graduation/student.php">Student Website</a></p>
			<? include("classes/student.php"); ?>
		</div>
</div>


</center>


	<p>&nbsp;</p>


	<!-- </form>	-->


</div>
</div>

<? include("includes/footer.php"); ?>
