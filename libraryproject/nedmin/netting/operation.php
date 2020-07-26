<?php 
ob_start();
session_start();


include 'dbconnection.php';
include '../production/function.php';

if (isset($_POST['saveuser'])) {
	
	$user_fullname=htmlspecialchars($_POST['user_fullname']);

	$user_email=htmlspecialchars($_POST['user_email']);


	$user_password=$_POST['user_password'];
	$user_password_confirm=$_POST['user_password_confirm'];

	if ($user_password == $user_password_confirm) {
		
		if (strlen($user_password)>=6) {


			$finduser=$db->prepare("SELECT * FROM user WHERE user_email=:email");
			$finduser->execute(array(
				'email' => $user_email
			));

			$count=$finduser->rowCount();


			if ($count==0) {


				$password= md5($user_password);

				$user_authority=1;


				$saveuser=$db->prepare("INSERT INTO user SET

					user_fullname=:user_fullname,
					user_email=:user_email,
					user_password=:user_password,
					user_authority=:user_authority
					");
				$insert=$saveuser->execute(array(
					'user_fullname'=>$user_fullname,
					'user_email'=>$user_email,
					'user_password'=>$password,
					'user_authority'=> $user_authority

				));



				if ($insert) {

					$_SESSION['user_email']=$user_email;


					header("Location:../../index.php?status=confirmed");
					


				}else{
					header("Location:../../register.php?status=error");
					exit;
				}


			}else{

				header("Location:../../register.php?status=user_exist");


			}



			
			


		}else{
			header("Location:../../register.php?status=password_short");

		}

	}else{

		header("Location:../../register.php?status=password_error");
		

	}



}


if (isset($_POST['updateuserpassword'])) {


	$user_email=$_SESSION['user_email'];



	$user_currentpassword=md5($_POST['user_password']);


	$user_newpassword=md5($_POST['user_newpassword']);
	$user_newpassword2=md5($_POST['user_newpassword2']);




	$finduser=$db->prepare("SELECT * FROM user WHERE user_email=:email");
	$finduser->execute(array(
		'email'=>$user_email

	));


	$getuser=$finduser->fetch(PDO::FETCH_ASSOC);

	
	if ($getuser['user_password']==$user_currentpassword) {

		if ($user_newpassword == $user_newpassword2) {
			
			$finduser2=$db->prepare("UPDATE user SET user_password=:password WHERE user_email=:email");
			$update=$finduser2->execute(array(
				
				'email'=>$user_email,

				'password'=>$user_newpassword

			));

			if ($update) {

				header("Location:../../updatepassword.php?status=confirmed");
				
			}else{

				header("Location:../../updatepassword.php?status=error");

			}

		}else{
			header("Location:../../updatepassword.php?status=passworderror");
		}
		
	}else{
		header("Location:../../updatepassword.php?status=wrongpassword");
	}


}




if (isset($_POST['adminlogin'])) {

	$user_email=htmlspecialchars($_POST['user_email']);	

	#Send decoded password to database
	$user_password= md5($_POST['user_password']);

	// $user_password= $_POST['user_password'];

	$findadmin=$db->prepare("SELECT * FROM user WHERE user_email=:email AND user_password=:password AND user_authority=:authority");
	$findadmin->execute(array(
		'email'=>$user_email,
		'password'=>$user_password,
		'authority'=> 5

	));

	echo $count=$findadmin->rowCount();

	if ($count==1) {
		
		$_SESSION['user_email']=$user_email;
		header("Location:../production/index.php?status=confirmed");


	}else{
		header("Location:../production/login.php?status=error");
		exit;
	}
}


if (isset($_POST['userlogin'])) {

	$user_email=htmlspecialchars($_POST['user_email']);

	#Send decoded password to database
	$user_password= md5($_POST['user_password']);

	// $user_password= $_POST['user_password'];

	$finduser=$db->prepare("SELECT * FROM user WHERE user_email=:email AND user_password=:password AND user_authority=:authority AND user_status=:status");
	$finduser->execute(array(
		'email'=>$user_email,
		'password'=>$user_password,
		'authority'=> 1,
		'status'=> 1

	));

	echo $count=$finduser->rowCount();

	if ($count==1) {
		
		$_SESSION['user_email']=$user_email;
		header("Location:../../index.php?status=confirmed");


	}else{
		header("Location:../../index.php?status=password_error");
		exit;
	}
}



if (isset($_POST['savegeneralsettings'])) {

	$saveChanges=$db->prepare("UPDATE settings SET 

		settings_title=:settings_title,
		settings_description=:settings_description,
		settings_keywords=:settings_keywords,
		settings_author=:settings_author
		WHERE settings_id=0");
	
	$update=$saveChanges->execute(array(
		'settings_title'=>$_POST['settings_title'],
		'settings_description'=>$_POST['settings_description'],
		'settings_keywords'=>$_POST['settings_keywords'],
		'settings_author'=>$_POST['settings_author']

	));

	if ($update) {
		header("Location:../production/generalsettings.php?status=confirmed");
	}else{
		header("Location:../production/generalsettings.php?status=error");
	}

}

if (isset($_POST['updatelogo'])) {


	// if ($_FILES['settings_logo']["size"]>178058) {
	// 	# Hata fırlat
	// }


	$allowed_extensions = array('jpg','gif','jpeg','png');

	$ext = strtolower(substr($_FILES['settings_logo']["name"], strpos($_FILES['settings_logo']["name"], '.')+1));


	if (in_array($ext, $allowed_extensions) === false) {
		
		echo "Forbidden file type";
		header("Location:../production/generalsettings.php?status=forbidden_file_type");

		exit;
	}


	$uploads_dir = '../../dimg';

	@$tmp_name = $_FILES['settings_logo']["tmp_name"];
	@$name = $_FILES['settings_logo']["name"];

	$randomnumber=rand(20000,32000);
	$refimgpath=substr($uploads_dir, 6)."/".$randomnumber.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$randomnumber$name");

	$saveChanges=$db->prepare("UPDATE settings SET 

		settings_logo=:settings_logo
		WHERE settings_id=0");
	
	$update=$saveChanges->execute(array(
		
		'settings_logo'=>$refimgpath
	));

	if ($update) {
		$deletelogounlink=$_POST['last_logo'];
		unlink("../../$deletelogounlink");

		header("Location:../production/generalsettings.php?status=confirmed");
	}else{
		header("Location:../production/generalsettings.php?status=error");
	}

}

if (isset($_POST['updatesliderimage'])) {

	$slider_id=$_POST['slider_id'];

	$uploads_dir = '../../dimg/slider';

	@$tmp_name = $_FILES['slider_imgpath']["tmp_name"];
	@$name = $_FILES['slider_imgpath']["name"];

	$randomnumber=rand(20000,32000);
	$refimgpath=substr($uploads_dir, 6)."/".$randomnumber.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$randomnumber$name");

	$saveChanges=$db->prepare("UPDATE slider SET 

		slider_imgpath=:slider_imgpath
		WHERE slider_id={$_POST['slider_id']}");
	
	$update=$saveChanges->execute(array(
		
		'slider_imgpath'=>$refimgpath
	));

	if ($update) {
		$deletelogounlink=$_POST['last_logo'];
		unlink("../../$deletelogounlink");

		header("Location:../production/slider.php?status=confirmed");
	}else{
		header("Location:../production/slider.php?status=error");
	}

}




if (isset($_POST['savesliderupdates'])) {

	$saveChanges=$db->prepare("UPDATE slider SET 

		slider_name=:slider_name,
		slider_content=:slider_content,
		slider_link=:slider_link,
		slider_index=:slider_index,
		slider_status=:slider_status
		WHERE slider_id={$_POST['slider_id']}");
	
	$update=$saveChanges->execute(array(
		'slider_name'=>$_POST['slider_name'],
		'slider_content'=>$_POST['slider_content'],
		'slider_link'=>$_POST['slider_link'],
		'slider_index'=>$_POST['slider_index'],
		'slider_status'=>$_POST['slider_status']

	));

	if ($update) {
		header("Location:../production/slider.php?status=confirmed");
	}else{
		header("Location:../production/slider.php?status=error");
	}

}

if (isset($_POST['savecommsettings'])) {

	$saveChanges=$db->prepare("UPDATE settings SET 

		settings_email=:settings_email,
		settings_address=:settings_address,
		settings_facebook=:settings_facebook,
		settings_twitter=:settings_twitter,
		settings_linkedin=:settings_linkedin

		WHERE settings_id=0");
	
	$update=$saveChanges->execute(array(
		'settings_email'=>$_POST['settings_email'],
		'settings_address'=>$_POST['settings_address'],
		'settings_facebook'=>$_POST['settings_facebook'],
		'settings_twitter'=>$_POST['settings_twitter'],
		'settings_linkedin'=>$_POST['settings_linkedin'],


	));

	if ($update) {
		header("Location:../production/communicatesettings.php?status=confirmed");
	}else{
		header("Location:../production/communicatesettings.php?status=error");
	}

}

if (isset($_POST['saveapisettings'])) {

	$saveChanges=$db->prepare("UPDATE settings SET 

		settings_analytics=:settings_analytics,
		settings_maps=:settings_maps,
		settings_zopim=:settings_zopim		
		WHERE settings_id=0");
	
	$update=$saveChanges->execute(array(
		'settings_analytics'=>$_POST['settings_analytics'],
		'settings_maps'=>$_POST['settings_maps'],
		'settings_zopim'=>$_POST['settings_zopim']

	));

	if ($update) {
		header("Location:../production/apisettings.php?status=confirmed");
	}else{
		header("Location:../production/apisettings.php?status=error");
	}

}

if (isset($_POST['savemailsettings'])) {

	$saveChanges=$db->prepare("UPDATE settings SET 

		settings_smtphost=:settings_smtphost,
		settings_smtpuser=:settings_smtpuser,
		settings_smtppassword=:settings_smtppassword,
		settings_smtpport=:settings_smtpport
		WHERE settings_id=0");
	
	$update=$saveChanges->execute(array(
		'settings_smtphost'=>$_POST['settings_smtphost'],
		'settings_smtpuser'=>$_POST['settings_smtpuser'],
		'settings_smtppassword'=>$_POST['settings_smtppassword'],
		'settings_smtpport'=>$_POST['settings_smtpport']

	));

	if ($update) {
		header("Location:../production/mailsettings.php?status=confirmed");
	}else{
		header("Location:../production/mailsettings.php?status=error");
	}

}

if (isset($_POST['saveabout'])) {

	$saveChanges=$db->prepare("UPDATE about SET 

		about_title=:about_title,
		about_content=:about_content,
		about_video=:about_video,
		about_vision=:about_vision,
		about_mission=:about_mission
		WHERE about_id=0");
	
	$update=$saveChanges->execute(array(
		'about_title'=>$_POST['about_title'],
		'about_content'=>$_POST['about_content'],
		'about_video'=>$_POST['about_video'],
		'about_vision'=>$_POST['about_vision'],
		'about_mission'=>$_POST['about_mission']


	));

	if ($update) {
		header("Location:../production/about.php?status=confirmed");
	}else{
		header("Location:../production/about.php?status=error");
	}

}


if (isset($_POST['saveuserupdates'])) {

	$user_id=$_POST['user_id'];

	$saveChanges=$db->prepare("UPDATE user SET 

		user_fullname=:user_fullname,
		user_password=:user_password,
		user_phone=:user_phone
		WHERE user_id={$_POST['user_id']}");
	
	$update=$saveChanges->execute(array(
		'user_fullname'=>$_POST['user_fullname'],
		'user_password'=>$_POST['user_password'],
		'user_phone'=>$_POST['user_phone']

	));

	if ($update) {
		header("Location:../production/users.php?status=confirmed");
	}else{
		header("Location:../production/users.php?status=error");
	}

}


if (isset($_POST['updateuserinfo'])) {



	$user_fullname=htmlspecialchars($_POST['user_fullname']);

	$user_phone=htmlspecialchars($_POST['user_phone']);

	$user_address=htmlspecialchars($_POST['user_address']);

	$user_city=htmlspecialchars($_POST['user_city']);


	$user_district=htmlspecialchars($_POST['user_district']);




	$user_id=$_POST['user_id'];


	$saveChanges=$db->prepare("UPDATE user SET 

		user_fullname=:user_fullname,
		user_phone=:user_phone,
		user_address=:user_address,
		user_city=:user_city,
		user_district=:user_district

		WHERE user_id={$_POST['user_id']}"
	);

	$update=$saveChanges->execute(array(
		'user_fullname'=>$user_fullname,
		'user_phone'=>$user_phone,
		'user_address'=>$user_address,
		'user_city'=>$user_city,
		'user_district'=>$user_district

	));


	if ($update) {
		header("Location:../../myaccount.php?status=confirmed");
	}else{
		header("Location:../../myaccount.php?status=error");
	}

}

if (!empty($_GET['deleteuser']) && $_GET['deleteuser']=='true') {

	$user_id=$_GET['user_id'];

	$saveChanges=$db->prepare("DELETE FROM user WHERE user_id=:id");
	
	$delete=$saveChanges->execute(array(
		'id'=>$_GET['user_id']
	));

	if ($delete) {
		header("Location:../production/users.php?status=confirmed");
	}else{
		header("Location:../production/users.php?status=error");
	}

}

if (isset($_POST['savemenuupdates'])) {

	$menu_id=$_POST['menu_id'];

	$menu_seourl=seo($_POST['menu_name']);





	$saveChanges=$db->prepare("UPDATE menu SET 

		menu_name=:menu_name,
		menu_url=:menu_url,
		menu_index=:menu_index,
		menu_seourl=:menu_seourl,
		menu_detail=:menu_detail,
		menu_status=:menu_status
		WHERE menu_id={$_POST['menu_id']}");
	
	$update=$saveChanges->execute(array(
		'menu_name'=>$_POST['menu_name'],
		'menu_url'=>$_POST['menu_url'],
		'menu_index'=>$_POST['menu_index'],
		'menu_seourl'=>$menu_seourl,
		'menu_detail'=>$_POST['menu_detail'],
		'menu_status'=>$_POST['menu_status']
	));

	if ($update) {
		header("Location:../production/menu.php?menu_id=$menu_id&status=confirmed");
	}else{
		header("Location:../production/menu.php?menu_id=$menu_id&status=error");
	}

}

if (!empty($_GET['deletemenu']) && $_GET['deletemenu']=='true') {

	$menu_id=$_GET['menu_id'];

	$saveChanges=$db->prepare("DELETE FROM menu WHERE menu_id=:id");
	
	$delete=$saveChanges->execute(array(
		'id'=>$_GET['menu_id']
	));

	if ($delete) {
		header("Location:../production/menu.php?status=confirmed");
	}else{
		header("Location:../production/menu.php?status=error");
	}

}


if (isset($_POST['addmenu'])) {

	$menu_seourl=seo($_POST['menu_name']);

	$saveChanges=$db->prepare("INSERT INTO menu SET 

		menu_name=:menu_name,
		menu_url=:menu_url,
		menu_index=:menu_index,
		menu_seourl=:menu_seourl,
		menu_detail=:menu_detail,
		menu_status=:menu_status
		");
	
	$insert=$saveChanges->execute(array(
		'menu_name'=>$_POST['menu_name'],
		'menu_url'=>$_POST['menu_url'],
		'menu_index'=>$_POST['menu_index'],
		'menu_seourl'=>$menu_seourl,
		'menu_detail'=>$_POST['menu_detail'],
		'menu_status'=>$_POST['menu_status']
	));

	if ($insert) {
		header("Location:../production/menu.php?status=confirmed");
	}else{
		header("Location:../production/menu.php?status=error");
	}

}

if (isset($_POST['addslider'])) {


	$uploads_dir = '../../dimg/slider';

	@$tmp_name = $_FILES['slider_imgpath']["tmp_name"];
	@$name = $_FILES['slider_imgpath']["name"];

	$randomnumber=rand(20000,32000);
	$refimgpath=substr($uploads_dir, 6)."/".$randomnumber.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$randomnumber$name");

	$saveChanges=$db->prepare("INSERT INTO slider SET 
		slider_name=:slider_name,
		slider_content=:slider_content,
		slider_link=:slider_link,
		slider_index=:slider_index,
		slider_status=:slider_status,
		slider_imgpath=:slider_imgpath"
	);
	
	$update=$saveChanges->execute(array(
		
		'slider_name'=>$_POST['slider_name'],
		'slider_content'=>$_POST['slider_content'],
		'slider_link'=>$_POST['slider_link'],
		'slider_index'=>$_POST['slider_index'],
		'slider_status'=>$_POST['slider_status'],
		'slider_imgpath'=>$refimgpath

	));

	if ($update) {

		header("Location:../production/slider.php?status=confirmed");
	}else{
		header("Location:../production/slider.php?status=error");
	}

}

if (!empty($_GET['deleteslider']) && $_GET['deleteslider']=='true') {

	$slider_id=$_GET['slider_id'];

	$saveChanges=$db->prepare("DELETE FROM slider WHERE slider_id=:id");
	
	$delete=$saveChanges->execute(array(
		'id'=>$_GET['slider_id']
	));

	if ($delete) {
		header("Location:../production/slider.php?status=confirmed");
	}else{
		header("Location:../production/slider.php?status=error");
	}

}

if (isset($_POST['addcategory'])) {

	$category_seourl=seo($_POST['category_name']);

	$saveChanges=$db->prepare("INSERT INTO category SET 
		category_name=:category_name,
		category_top=:category_top,
		category_icon=:category_icon,
		category_seourl=:category_seourl,
		category_index=:category_index,
		category_status=:category_status"
	);
	
	$update=$saveChanges->execute(array(
		
		'category_name'=>$_POST['category_name'],
		'category_top'=>$_POST['category_top'],
		'category_icon'=>$_POST['category_icon'],
		'category_seourl'=>$category_seourl,
		'category_index'=>$_POST['category_index'],
		'category_status'=>$_POST['category_status']

	));

	if ($update) {

		header("Location:../production/category.php?status=confirmed");
	}else{
		header("Location:../production/category.php?status=error");
	}

}

if (isset($_POST['savecategoryupdates'])) {

	$category_seourl=seo($_POST['category_name']);


	$saveChanges=$db->prepare("UPDATE category SET 

		category_name=:category_name,
		category_top=:category_top,
		category_icon=:category_icon,
		category_seourl=:category_seourl,
		category_index=:category_index,
		category_status=:category_status
		WHERE category_id={$_POST['category_id']}");
	
	$update=$saveChanges->execute(array(
		'category_name'=>$_POST['category_name'],
		'category_top'=>$_POST['category_top'],
		'category_icon'=>$_POST['category_icon'],
		'category_seourl'=>$category_seourl,
		'category_index'=>$_POST['category_index'],
		'category_status'=>$_POST['category_status']

	));

	if ($update) {
		header("Location:../production/category.php?status=confirmed&category_id=$category_id");
	}else{
		header("Location:../production/category.php?status=error&category_id=$category_id");
	}

}

if (!empty($_GET['deletecategory']) && $_GET['deletecategory']=='true') {

	$category_id=$_GET['category_id'];

	$saveChanges=$db->prepare("DELETE FROM category WHERE category_id=:id");
	
	$delete=$saveChanges->execute(array(
		'id'=>$_GET['category_id']
	));

	if ($delete) {
		header("Location:../production/category.php?status=confirmed");
	}else{
		header("Location:../production/category.php?status=error");
	}

}


if (isset($_POST['addproduct'])) {

	$product_seourl=seo($_POST['product_name']);

	$saveChanges=$db->prepare("INSERT INTO product SET 

		product_name=:product_name,
		category_id=:category_id,
		product_price=:product_price,
		product_stock=:product_stock,
		product_keyword=:product_keyword,
		product_seourl=:product_seourl,
		product_detail=:product_detail,
		product_status=:product_status
		");
	
	$insert=$saveChanges->execute(array(
		'product_name'=>$_POST['product_name'],
		'category_id'=>$_POST['category_id'],
		'product_price'=>$_POST['product_price'],
		'product_stock'=>$_POST['product_stock'],
		'product_keyword'=>$_POST['product_keyword'],
		'product_seourl'=>$product_seourl,
		'product_detail'=>$_POST['product_detail'],
		'product_status'=>$_POST['product_status']
	));

	if ($insert) {
		header("Location:../production/product.php?status=confirmed");
	}else{
		header("Location:../production/product.php?status=error");
	}

}

if (isset($_POST['saveproductupdates'])) {

	$product_id=$_POST['product_id'];

	$product_seourl=seo($_POST['product_name']);





	$saveChanges=$db->prepare("UPDATE product SET 

		product_name=:product_name,
		category_id=:category_id,
		product_price=:product_price,
		product_stock=:product_stock,
		product_keyword=:product_keyword,
		product_front=:product_front,
		product_seourl=:product_seourl,
		product_detail=:product_detail,
		product_status=:product_status
		WHERE product_id={$_POST['product_id']}");
	
	$update=$saveChanges->execute(array(
		'product_name'=>$_POST['product_name'],
		'category_id'=>$_POST['category_id'],
		'product_price'=>$_POST['product_price'],
		'product_stock'=>$_POST['product_stock'],
		'product_keyword'=>$_POST['product_keyword'],
		'product_front'=>$_POST['product_front'],
		'product_seourl'=>$product_seourl,
		'product_detail'=>$_POST['product_detail'],
		'product_status'=>$_POST['product_status']
	));

	if ($update) {
		header("Location:../production/product.php?product_id=$product_id&status=confirmed");
	}else{
		header("Location:../production/product.php?product_id=$product_id&status=error");
	}

}


if (!empty($_GET['deleteproduct']) && $_GET['deleteproduct']=='true') {

	$product_id=$_GET['product_id'];

	$saveChanges=$db->prepare("DELETE FROM product WHERE product_id=:id");
	
	$delete=$saveChanges->execute(array(
		'id'=>$_GET['product_id']
	));

	if ($delete) {
		header("Location:../production/product.php?status=confirmed");
	}else{
		header("Location:../production/product.php?status=error");
	}

}

if (isset($_POST['addcomment'])) {

	$product_url = $_POST['product_url'];
	$product_id = $_POST['product_id'];

	$saveChanges=$db->prepare("INSERT INTO comments SET 

		comment_detail=:comment_detail,
		user_id=:user_id,
		product_id=:product_id

		");
	
	$insert=$saveChanges->execute(array(
		'comment_detail'=>$_POST['comment_detail'],
		'user_id'=>$_POST['user_id'],
		'product_id'=>$product_id

	));

	if ($insert) {
		header("Location:$product_url?status=confirmed");
	}else{
		header("Location:../../index.php?status=error");
	}

}

if (!empty($_GET['deletecomment']) && $_GET['deletecomment']=='true') {


	$comment_id=$_GET['comment_id'];

	$saveChanges=$db->prepare("DELETE FROM comments WHERE comment_id=:comment_id");
	
	$delete=$saveChanges->execute(array(
		'comment_id'=>$_GET['comment_id']
	));

	if ($delete) {
		header("Location:../production/comments.php?status=confirmed");
	}else{
		header("Location:../production/comments.php?status=error");
	}

}


if (isset($_POST['addcart'])) {

	$user_id = $_POST['user_id'];
	$product_id = $_POST['product_id'];
	$product_amount = $_POST['product_amount'];



	$saveChanges=$db->prepare("INSERT INTO cart SET 

		user_id=:user_id,
		product_id=:product_id,
		product_amount=:product_amount


		");
	
	$insert=$saveChanges->execute(array(

		'user_id'=>$user_id,
		'product_id'=>$product_id,
		'product_amount'=>$product_amount

	));

	if ($insert) {
		header("Location:../../cart.php?status=confirmed");
	}else{
		header("Location:../../cart.php?status=error");
	}

}

if (!empty($_GET['deletecart']) && $_GET['deletecart']=='true') {

	$turnback_url = $_GET['turnback_url'];

	$cart_id=$_GET['cart_id'];

	$saveChanges=$db->prepare("DELETE FROM cart WHERE cart_id=:id");
	
	$delete=$saveChanges->execute(array(
		'id'=>$_GET['cart_id']
	));

	if ($delete) {
		header("Location:$turnback_url?status=confirmed");
	}else{
		header("Location:$turnback_url?status=error");
	}

}


if (isset($_POST['addbank'])) {

	

	$saveChanges=$db->prepare("INSERT INTO bank SET 
		bank_name=:bank_name,
		bank_iban=:bank_iban,
		bank_accountname=:bank_accountname,
		
		bank_status=:bank_status"
	);
	
	$update=$saveChanges->execute(array(
		
		'bank_name'=>$_POST['bank_name'],
		'bank_iban'=>$_POST['bank_iban'],
		'bank_accountname'=>$_POST['bank_accountname'],
		
		'bank_status'=>$_POST['bank_status']

	));

	if ($update) {

		header("Location:../production/bank.php?status=confirmed");
	}else{
		header("Location:../production/bank.php?status=error");
	}

}


if (isset($_POST['savebankupdates'])) {



	$saveChanges=$db->prepare("UPDATE bank SET 

		bank_name=:bank_name,
		bank_iban=:bank_iban,
		bank_accountname=:bank_accountname,
		
		bank_status=:bank_status
		WHERE bank_id={$_POST['bank_id']}");
	
	$update=$saveChanges->execute(array(
		'bank_name'=>$_POST['bank_name'],
		'bank_iban'=>$_POST['bank_iban'],
		'bank_accountname'=>$_POST['bank_accountname'],
		
		'bank_status'=>$_POST['bank_status']

	));

	if ($update) {
		header("Location:../production/bank.php?status=confirmed&bank_id=$bank_id");
	}else{
		header("Location:../production/bank.php?status=error&bank_id=$bank_id");
	}

}


if (!empty($_GET['deletebank']) && $_GET['deletebank']=='true') {

	$bank_id=$_GET['bank_id'];

	$saveChanges=$db->prepare("DELETE FROM bank WHERE bank_id=:id");
	
	$delete=$saveChanges->execute(array(
		'id'=>$_GET['bank_id']
	));

	if ($delete) {
		header("Location:../production/bank.php?status=confirmed");
	}else{
		header("Location:../production/bank.php?status=error");
	}

}



if (isset($_POST['addbankorder'])) {

	

	$order_type = 'Bank Transfer';

	$saveChanges=$db->prepare("INSERT INTO orders SET 
		user_id=:user_id,
		order_type=:order_type,
		order_bank=:order_bank,
		order_total=:order_total
		"
	);
	
	$insert=$saveChanges->execute(array(
		
		'user_id'=>$_POST['user_id'],
		'order_type'=>$order_type,
		'order_bank'=>$_POST['order_bank'],
		'order_total'=>$_POST['order_total']

	));

	if ($insert) {

		echo $order_id=$db->lastInsertId();

		echo "<hr>";

		$user_id = $_POST['user_id'];

		$findcart=$db->prepare("SELECT * FROM cart WHERE user_id=:id");
		$findcart->execute(array(
			'id'=>$user_id
		));


		while ($getcart = $findcart->fetch(PDO::FETCH_ASSOC)) {
			
			$product_id = $getcart['product_id'];
			$product_amount = $getcart['product_amount'];


			$findproduct=$db->prepare("SELECT * FROM product WHERE product_id=:id");
			$findproduct->execute(array(
				'id'=>$product_id
			));

			$getproduct = $findproduct->fetch(PDO::FETCH_ASSOC);

			$product_price = $getproduct['product_price'];


			$saveChanges=$db->prepare("INSERT INTO order_detail SET 
				order_id=:order_id,
				product_id=:product_id,
				product_price=:product_price,
				product_amount=:product_amount

				"
			);

			$update=$saveChanges->execute(array(

				'order_id'=>$order_id,
				'product_id'=>$product_id,
				'product_price'=>$product_price,
				'product_amount'=>$product_amount


			));


			if ($update) {

				$saveChanges=$db->prepare("DELETE FROM cart WHERE user_id=:id");

				$delete=$saveChanges->execute(array(
					'id'=>$user_id
				));

				if ($delete) {
					header("Location:../../myorders.php?status=confirmed");
					
				}
				
			}

		}
		

		


	}else{
		echo "Operation error"; exit;


		// header("Location:../production/order.php?status=error");
	}

}

if (isset($_POST['productdeleteimage'])) {

	$product_id=$_POST['product_id'];

	$checklist = $_POST['productimageselect'];

	foreach ($checklist as $list) {

		$saveChanges=$db->prepare("DELETE FROM product_img WHERE product_img_id=:id");

		$delete=$saveChanges->execute(array(
			'id'=>$list
		));
	}

	

	if ($delete) {
		header("Location:../production/product-galery.php?status=confirmed&product_id=$product_id");
	}else{
		header("Location:../production/product-galery.php?status=error&product_id=$product_id");
	}

}

?>