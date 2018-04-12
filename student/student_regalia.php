<?php
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
	header("Pragma: no-cache");
	//require_once("./ldap/session.php");

	include("../includes/header.php");
	include("../includes/nav.php");
	require_once("../includes/connection.php");
	include("../controllers/graduation_deadlines.php");

?>

<?php
	echo $current_term."<br >if current term is displayed. connection and deadlines work";
?>

<div class="container mt-1">
	<div class="row">
		<div class="col-md-12 text-center">
			<h2 class="rale2">Grad Salute - Home Ship</h2>


<form action="gradsalute_homeship2.php?search=&<? echo $_GET["search"];?>" method="GET" id="student_homeship">
  Search for Student to Enter ID, First Name, Last Name, UARK Email, or Address: <br /><input name="search" width="15">
  <button type="submit" value="<? echo mysql_result($result, 0, 'email');?>">Search Students</button>
</form>

<p>
<a href='http://uofastore.com/Bookstore/grad/logs/grad_salute_homeship.csv'>
<b>Download Full List</b></a> | To Export into Excel -- Right-click on 'Download File' and use Save Link As and Open the file
</p>

<table bgcolor=#ffffff border=0 cellpadding=5 cellspacing=0 class="table">
	<tr valign=top>
<tr bgcolor='#cecece' align=center valign=center>
<th></th>
<th>Year</th>
<th>Semester</th>
<th>C Term</th>
<th>Level</th>
<th>Degree</th>
<th>ID</th>
<th>F Name</th>
<th>L Name</th>
<th>Email</th>
<th>Address</th>
<th>City</th>
<th>State</th>
<th>Zip</th>
</tr>

<?

$header = "student_id,email,firstname,lastname,address,city,state,zip,year,level,degree\n";

$dir = "/export/home/ua/bookstor/Bookstore/grad/logs/";
$filename = $dir."grad_salute_homeship.csv";
$fp1 = fopen($filename,"w") or die("can't open file");
fwrite($fp1,$header);
fclose($fp1);

$year = date("Y");
if(date("m")>8){$season = "Fall";} else {$season = "Spring";}

$sqlquery = "
SELECT * FROM graduates
  WHERE comm_term = '$current_term'
  	AND (student_id LIKE '%".$_GET{'search'}."%'
    OR firstname LIKE '%".$_GET{'search'}."%'
    OR lastname LIKE '%".$_GET{'search'}."%'
    OR email LIKE '%".$_GET{'search'}."%'
    OR address LIKE '%".$_GET{'search'}."%')
  ORDER BY order_date DESC, Term DESC, lastname, firstname;
";

$result=mysql_query($sqlquery);

if ($result==""){}
else {
	$num=mysql_num_rows($result);
}

$i=0;

while ($i < $num) {

$j = $i;
$j = ++$j;

$id=mysql_result($result,$i,"student_id");
$year=mysql_result($result,$i,"year");
$semester=mysql_result($result,$i,"season");
$term=mysql_result($result,$i,"term");
$level=mysql_result($result,$i,"level");
$degree=mysql_result($result,$i,"degree");
$firstname=mysql_result($result,$i,"firstname");
$lastname=mysql_result($result,$i,"lastname");
$comm_term=mysql_result($result,$i,"comm_term");
$attend_comm=mysql_result($result,$i,"attend_comm");
$email=mysql_result($result,$i,"email");
$address=mysql_result($result,$i,"address");
$city=mysql_result($result,$i,"city");
$state=mysql_result($result,$i,"state");
$zip=mysql_result($result,$i,"zip");
$order_date=mysql_result($result,$i,"order_date");

$id=str_replace(",", "",$id);
$year=str_replace(",", "",$year);
$semester=str_replace(",", "",$semester);
$level=str_replace(",", "",$level);
$firstname=str_replace(",", "",$firstname);
$lastname=str_replace(",", "",$lastname);
$comm_term=str_replace(",", "",$comm_term);
$attend_comm=str_replace(",", "",$attend_comm);
$email=str_replace(",", "",$email);
$address=str_replace(",", "",$address);
$city=str_replace(",", "",$city);
$state=str_replace(",", "",$state);
$zip=str_replace(",", "",$zip);

if($state==""||$state==" "||$state=="AE"||$state=="ON"||$state=="PR"||$state=="CH"||$state=="BW"){
    $address="";
    $city="";
    $state="";
    $zip="";
  }
/*
if($order_date == "0000-00-00" || $order_date == ""){echo "<tr><td nowrap><a href='http://uofastore.com/grad_salute/student_regalia.php?student_id=$id&year=$year&commencement=$semester'>Pick-up</a></td>";}
if($order_date != "0000-00-00" && $order_date != ""){echo "<tr><td nowrap bgcolor='#CC0033'><b><a href='http://uofastore.com/grad_salute/student_regalia.php?student_id=$id&year=$year&commencement=$semester'><font color='#ffffff'>Picked</font></a></b></td>";}
*/
if($order_date >= "2017-01-30" || $gown == ""){echo "<tr><td nowrap><a href='http://uofastore.com/grad_salute/student_regalia.php?search=$id&year=$year&commencement=$semester'>Pick-up</a></td>";}
if($order_date < "2017-01-29" && $gown == "1"){echo "<tr><td nowrap bgcolor='#CC0033'><b><a href='http://uofastore.com/grad_salute/student_regalia.php?search=$id&year=$year&commencement=$semester'><font color='#ffffff'>Picked</font></a></b></td>";}

echo "
<td>$year</td>
<td>$semester</td>
<td>$comm_term</td>
<td>$level</td>
<td>$degree</td>
<td>$id</td>
<td nowrap>$firstname</td>
<td nowrap>$lastname</td>
<td nowrap>$email</td>
<td nowrap>$address</td>
<td nowrap>$city</td>
<td>$state</td>
<td nowrap>$zip</td>
</tr>
";

$fp2 = fopen($filename,"a") or die("can't open file");
$export = $id.",".$email.",".$firstname.",".$lastname.",".$address.",".$city.",".$state.",".$zip.",".$year.",".$level.",".$degree."\n";
fwrite($fp2,$export);
fclose($fp2);

$i++;

}

mysql_close();

?>

</table>
</div>



      </div>
	</div>
</div>


<?php
	include("../includes/footer.php");
?>
