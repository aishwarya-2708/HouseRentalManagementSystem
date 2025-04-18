<?php 

$db = new mysqli('localhost','root','','house_rental_latest');

if($db->connect_error){
	echo "Error connecting database";
}

 ?>