<?php
// Use This To Update Grad List From Registrar
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
	header("Pragma: no-cache");
	//require_once("./ldap/session.php");

	include("includes/header.php");
	include("includes/nav.php");
	include("includes/connection.php");


//Clear Tables
mysql_query("TRUNCATE TABLE get_grad");
mysql_query("TRUNCATE TABLE get_grad_temp");


//Load Students
mysql_query("LOAD DATA INFILE '/export/home/ua/bookstor/exports/Graduates.txt'
		INTO TABLE get_grad FIELDS TERMINATED BY '| ' IGNORE 3 LINES (blank,student_id,lastname,firstname,level,acad_career,degree,honors,acad_prog,term,year,comm_term,attend_comm,graduates_nophone,email,perm_address1,perm_address2,perm_address3,perm_city,perm_state,perm_zip,mail_address1,mail_address2,mail_address3,mail_city,mail_state,mail_zip,dip_address1,dip_address2,dip_address3,dip_city,dip_state,dip_zip,perm_phone,cell_phone,deceased_date)");

//mysql_query("DELETE FROM get_grad WHERE student_id LIKE '-%'");
//mysql_query("DELETE FROM get_grad WHERE student_id LIKE ' %'");
//mysql_query("DELETE FROM get_grad WHERE student_id LIKE ''");

mysql_query("UPDATE get_grad SET mail_address1='', mail_address2='', mail_address3='', mail_state ='', mail_zip=''
              WHERE mail_state = '' OR mail_state = ' '");

mysql_query("UPDATE get_grad SET perm_address1 = '', perm_address2 = '', perm_address3 = '', perm_city = '', perm_state = '', perm_zip = ''
              WHERE perm_state = '' OR perm_state = ' '");

/*
//Update Table
mysql_query('UPDATE graduates AS grads
  LEFT JOIN ( SELECT graduates_regalia.degree, graduates_regalia.regalia_sku
  FROM graduates_regalia
  ) AS regalia ON regalia.degree = grads.degree
  SET grads.regalia_sku = regalia.regalia_sku
  WHERE grads.degree = regalia.degree
');
*/


if(Date("m")< 8 ){
		$season="Spring";
} else {$season="Fall";}

$today = date("Y-n-j");


//INSERT get_grad_temp INTO graduates

$sqlquery = "SELECT * FROM get_grad";

$result=mysql_query($sqlquery);

if ($result==""){}
else {
        $num=mysql_num_rows($result);
}

$i=0;

while ($i < $num) {

$student_id=mysql_result($result,$i,'student_id');
$firstname=mysql_result($result,$i,'firstname');
$lastname=mysql_result($result,$i,'lastname');
$level=mysql_result($result,$i,'level');
$acad_career=mysql_result($result,$i,'acad_career');
$degree=mysql_result($result,$i,'degree');
$honors=mysql_result($result,$i,'honors');
$acad_prog=mysql_result($result,$i,'acad_prog');
$term=mysql_result($result,$i,'term');
$year=mysql_result($result,$i,'year');
$comm_term=mysql_result($result,$i,'comm_term');
$attend_comm=mysql_result($result,$i,'attend_comm');
$email=mysql_result($result,$i,'email');
$cell_phone=mysql_result($result,$i,'cell_phone');
$perm_address1=mysql_result($result,$i,'perm_address1');
$perm_address2=mysql_result($result,$i,'perm_address2');
$perm_address3=mysql_result($result,$i,'perm_address3');
$perm_city=mysql_result($result,$i,'perm_city');
$perm_state=mysql_result($result,$i,'perm_state');
$perm_zip=mysql_result($result,$i,'perm_zip');
$mail_address1=mysql_result($result,$i,'mail_address1');
$mail_address2=mysql_result($result,$i,'mail_address2');
$mail_address3=mysql_result($result,$i,'mail_address3');
$mail_city=mysql_result($result,$i,'mail_city');
$mail_state=mysql_result($result,$i,'mail_state');
$mail_zip=mysql_result($result,$i,'mail_zip');
$deceased_date=mysql_result($result,$i,'deceased_date');

$student_id=str_replace(" ", "",$student_id);
$firstname=str_replace(",", "",$firstname);
$firstname=str_replace("  ", "",$firstname);
$lastname=str_replace(",", "",$lastname);
$lastname=str_replace("  ", "",$lastname);
$email=str_replace(" ", "",$email);
$cell_phone=str_replace(" ", "",$cell_phone);
$year=str_replace(" ", "",$year);
$comm_term=str_replace(" ", "",$comm_term);
$attend_comm=str_replace(" ", "",$attend_comm);
$level=str_replace(" ", "",$level);
$acad_career=str_replace(" ", "",$acad_career);
$degree=str_replace(" ", "",$degree);
$honors=str_replace(" ", "",$honors);
$acad_prog=str_replace(" ", "",$acad_prog);
$term=str_replace(" ", "",$term);
$perm_address1=str_replace(",", "",$perm_address1);
$perm_address1=str_replace("  ", "",$perm_address1);
$perm_address2=str_replace(",", "",$perm_address2);
$perm_address3=str_replace(",", "",$perm_address3);
$perm_city=str_replace(",", "",$perm_city);
$perm_city=str_replace("  ", "",$perm_city);
$perm_state=str_replace(",", "",$perm_state);
$perm_state=str_replace(" ", "",$perm_state);
$perm_zip=str_replace(",", "",$perm_zip);
$perm_zip=str_replace(" ", "",$perm_zip);

$grad_id=$student_id.".".$degree.".".$acad_prog.".".$year.".".$season;
//$deceased_date = date("Y-n-j",$deceased_date);

//Update Levels
if($level=="Bachelor"){$level="Bachelors";}
if($level=="Master"){$level="Masters";}
if($level=="Doctorate"){$level="Doctorates";}

//Update Addresses
$address=$perm_address1." ".$perm_address2." ".$perm_address3;
$address=str_replace("  ", "",$address);
$city=$perm_city;
$state=$perm_state;
$zip=$perm_zip;

if($address==""){$address="";$city="";$state="";$zip="";}
if($address==" "){$address="";$city="";$state="";$zip="";}
if($address=="  "){$address="";$city="";$state="";$zip="";}
if($perm_city==""){$address="";$city="";$state="";$zip="";}
if($perm_city==" "){$address="";$city="";$state="";$zip="";}
if($perm_state==""){$address="";$city="";$state="";$zip="";}
if($perm_state==" "){$address="";$city="";$state="";$zip="";}

$capsize = "1-size";
$cap_sku = "1853578";

//INSERT get_grad INTO get_grad_temp
mysql_query("INSERT INTO get_grad_temp (grad_id, student_id, firstname, lastname, email, cell_phone, year, term, comm_term, attend_comm, season, level, degree, honors, acad_career, acad_prog, address, city, state, zip, capsize, cap_sku, tassel_sku, hood_sku, degree_color, deceased_date)
              VALUES ('$grad_id','$student_id','$firstname','$lastname','$email','$cell_phone','$year','$term','$comm_term','$attend_comm','$season','$level','$degree','$honors','$acad_career','$acad_prog','$address','$city','$state','$zip','$capsize','$cap_sku','$tassel_sku','$hood_sku','$degree_color','$deceased_date')
");


//UPDATE existing graduatesaddresses
mysql_query("UPDATE graduates SET address='$address', city='$city', state='$state', zip='$zip'
                WHERE grad_id='$grad_id' AND address = ''");

$i++;
}

mysql_query("UPDATE get_grad_temp SET address = '', city = '', state = '', zip = ''
              WHERE city = ''");

mysql_query("UPDATE get_grad_temp JOIN graduates_degrees ON get_grad_temp.degree = graduates_degrees.degree
            SET get_grad_temp.degree_color = graduates_degrees.color");

mysql_query("UPDATE get_grad_temp JOIN graduates_regalia ON get_grad_temp.degree_color = graduates_regalia.color
            SET get_grad_temp.tassel_sku = graduates_regalia.sku
            WHERE get_grad_temp.tassel_sku='' AND graduates_regalia.type='tassel'");

mysql_query("UPDATE get_grad_temp JOIN graduates_regalia ON get_grad_temp.degree_color = graduates_regalia.color
            SET get_grad_temp.hood_sku = graduates_regalia.sku
            WHERE get_grad_temp.hood_sku='' AND graduates_regalia.type='hood'");

mysql_query("UPDATE get_grad_temp SET get_grad_temp.hood_sku = ''
            WHERE get_grad_temp.level='Bachelors'");


//INSERT get_grad_temp INTO graduates
mysql_query("INSERT INTO graduates ( grad_id, student_id, firstname, lastname, email, cell_phone, year, term, season, comm_term, attend_comm, level, degree, honors, acad_prog, acad_career,
             address, city, state, zip, capsize, cap_sku, tassel_sku, hood_sku, degree_color, registration_date, deceased_date )
              SELECT DISTINCT get_grad_temp.grad_id, get_grad_temp.student_id, get_grad_temp.firstname, get_grad_temp.lastname,
              get_grad_temp.email, get_grad_temp.cell_phone, get_grad_temp.year, get_grad_temp.term, get_grad_temp.season, get_grad_temp.comm_term, get_grad_temp.attend_comm, get_grad_temp.level, get_grad_temp.degree, get_grad_temp.honors, get_grad_temp.acad_prog,
              get_grad_temp.acad_career, get_grad_temp.address, get_grad_temp.city, get_grad_temp.state, get_grad_temp.zip, get_grad_temp.capsize,
              get_grad_temp.cap_sku, get_grad_temp.tassel_sku, get_grad_temp.hood_sku, get_grad_temp.degree_color, get_grad_temp.registration_date, get_grad_temp.deceased_date
              FROM get_grad_temp
              LEFT JOIN graduates ON get_grad_temp.grad_id = graduates.grad_id
              WHERE graduates.grad_id IS NULL");

mysql_query("UPDATE graduates JOIN get_grad_temp ON graduates.grad_id = get_grad_temp.grad_id
            SET graduates.registration_date = '$today'
            WHERE graduates.registration_date='' OR graduates.registration_date='0000-00-00'");

mysql_query("UPDATE graduates JOIN graduates_regalia ON graduates.degree_color = graduates_regalia.color
            SET graduates.hood_sku = graduates_regalia.sku
            WHERE graduates.hood_sku='' AND graduates_regalia.type='hood'");


// UPDATE MISSING REGALIA INFO
mysql_query("UPDATE graduates INNER JOIN graduates_regalia ON (graduates.level = graduates_regalia.level)
            AND (graduates.height = graduates_regalia.size)
            SET graduates.gown_sku = graduates_regalia.sku
            WHERE graduates.gown_sku='' AND graduates_regalia.type='gown'");

mysql_query("UPDATE graduates INNER JOIN graduates_regalia ON graduates.capsize = graduates_regalia.size
            SET graduates.cap_sku = graduates_regalia.sku
            WHERE graduates.cap_sku='' AND graduates_regalia.type='cap'");

mysql_query("UPDATE graduates INNER JOIN graduates_regalia ON graduates.degree_color = graduates_regalia.degree_color
            SET graduates.hood_sku = graduates_regalia.sku
            WHERE graduates.hood_sku=''
            AND graduates_regalia.type='hood'
            AND graduates_regalia.level='Masters'");

mysql_query("UPDATE graduates INNER JOIN graduates_regalia ON graduates.degree_color = graduates_regalia.degree_color
            SET graduates.hood_sku = graduates_regalia.sku
            WHERE graduates.hood_sku=''
            AND graduates_regalia.type='hood'
            AND graduates_regalia.level='Doctorates'");

mysql_query("UPDATE graduates SET gown = '1', cap = '1', tassel = '1', hood = ''
              WHERE gown ='' AND height <>'' AND level='Bachelors'");

mysql_query("UPDATE graduates SET gown = '1', cap = '1', tassel = '1', hood = '1'
              WHERE gown ='' AND height <>'' AND level<>'Bachelors'");


mysql_query("UPDATE graduates INNER JOIN graduates_degrees ON graduates.degree = graduates_degrees.degree
            SET graduates.cap = '1', graduates.tassel = '1', graduates.degree_color = graduates_degrees.color, graduates.hood = '', graduates.degree_color = graduates_degrees.color
            WHERE graduates.tassel='' AND graduates.gown='1' AND graduates.level='Bachelors'");

mysql_query("UPDATE graduates INNER JOIN graduates_degrees ON graduates.degree = graduates_degrees.degree
            SET graduates.cap = '1', graduates.tassel = '1', graduates.degree_color = graduates_degrees.color, graduates.hood = '1', graduates.degree_color = graduates_degrees.color
            WHERE graduates.tassel='' AND graduates.gown='1' AND graduates.level<>'Bachelors'");

mysql_query("UPDATE graduates
            SET graduates.hood = '', graduates.degree_color = 'Black'
            WHERE graduates.level='Bachelors'");

mysql_query("UPDATE graduates SET graduates.level = 'Bachelors'
            WHERE graduates.level='Bachelor'");

mysql_query("UPDATE graduates SET graduates.level = 'Masters'
            WHERE graduates.level='Master'");

mysql_query("UPDATE graduates SET graduates.level = 'Doctorates'
            WHERE graduates.level='Doctorate'");

mysql_query("UPDATE graduates SET graduates.degree = 'M.AT'
            WHERE graduates.degree='M.AT.'");

mysql_close();

echo "<font color=red><b>Student graduates have been Uploaded and Updated</b></font><p>&nbsp;";

?>
