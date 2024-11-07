<?php
$username="root";
$hostname="localhost";
$password="";
$db_name="blog";
$conn=new MySQLi($hostname,$username,$password,$db_name);




if($conn->connect_error)
{
  die("database connection error: ".$conn->connect_error);

}


?>