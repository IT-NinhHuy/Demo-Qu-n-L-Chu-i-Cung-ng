<?php
$conn_error='Không thể kết nối.';
$mysql_host='localhost';
$mysql_user='root';
$mysql_pass='';
$mysql_db='supplier';

$con=mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
// Check connection
if (mysqli_connect_errno()){
	echo "Không kết nối với MySQL: " . mysqli_connect_error();
}
	