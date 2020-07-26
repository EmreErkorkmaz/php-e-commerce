<?php 

try {

	$db=new PDO("mysql:host=localhost;port=3307;dbname=eticaret;charset=utf8",'root','12345678');
	// echo "Connection Successful";
} catch (PDOException $e) {
	echo $e->getMessage();
}

 ?>