<?php

$host="localhost";
$uname="root";
$pass="";
$dbname="biohealth";

$connection = mysqli_connect($host,$uname,$pass,$dbname);
// veritabanındaki harflerin düzgün gözükmemesi için.
mysqli_set_charset($connection, "UTF8");
//bağlantıyı sorgulamak için
 //if($connection){
 //echo "bağlantı başarılı.";
 //}
?>
