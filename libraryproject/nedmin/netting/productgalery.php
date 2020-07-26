<?php 

ob_start();
session_start();

include 'dbconnection.php';

if (!empty($_FILES)) {



	$uploads_dir = '../../dimg/product';
	@$tmp_name = $_FILES['file']["tmp_name"];
	@$name = $_FILES['file']["name"];
	$unique_number1=rand(20000,32000);
	$unique_number2=rand(20000,32000);
	$unique_number3=rand(20000,32000);
	$unique_number4=rand(20000,32000);

	$unique_name=$unique_number1.$unique_number2.$unique_number3.$unique_number4;
	$refimgpath=substr($uploads_dir, 6)."/".$unique_name.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$unique_name$name");

	$product_id=$_POST['product_id'];

	$kaydet=$db->prepare("INSERT INTO product_img SET
		product_img_path=:img_path,
		product_id=:product_id");
	$insert=$kaydet->execute(array(
		'img_path' => $refimgpath,
		'product_id' => $product_id
		));




}





?>