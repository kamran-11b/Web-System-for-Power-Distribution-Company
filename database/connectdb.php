<?php
$host="localhost";
$username="root";
$password="";
$database="pdc_website";
$connect=new mysqli($host, $username, $password, $database);

if($connect->connect_errno)
{
	die("Error :".$conn->connect_errno);
	
}
else {
//  echo 'Database Connection Establish Successfully!!';
}
?>


