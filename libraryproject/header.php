<?php

include 'nedmin/netting/dbconnection.php';
include 'nedmin/production/function.php';

$findsetting=$db->prepare("SELECT * FROM settings WHERE settings_id=:id");
$findsetting->execute(array(
	'id'=>0
));

$getsetting=$findsetting->fetch(PDO::FETCH_ASSOC);


if (isset($_SESSION['user_email'])) {
	


	$finduser=$db->prepare("SELECT * FROM user WHERE user_email=:email");
	$finduser->execute(array(
		'email'=>$_SESSION['user_email']
	));
	$count=$finduser->rowCount();

	$getuser=$finduser->fetch(PDO::FETCH_ASSOC);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $getsetting['settings_title'] ?></title>
	<meta name="description" content="<?php echo $getsetting['settings_description'] ?>">
	<meta name="keywords" content="<?php echo $getsetting['settings_keywords'] ?>">
	<meta name="author" content="<?php echo $getsetting['settings_author'] ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link href='font-awesome\css\font-awesome.css' rel="stylesheet" type="text/css">
	<!-- Bootstrap -->
	<link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
	
	<!-- Main Style -->
	<link rel="stylesheet" href="style.css">
	
	<!-- owl Style -->
	<link rel="stylesheet" href="css\owl.carousel.css">
	<link rel="stylesheet" href="css\owl.transitions.css">

	<!-- fancy Style -->
	<link rel="stylesheet" type="text/css" href="js\product\jquery.fancybox.css?v=2.1.5" media="screen">
	

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
	<div id="wrapper">
		<div class="header"><!--Header -->
			<div class="container">
				<div class="row">
					<div class="col-xs-6 col-md-4 main-logo">
						<a href="index.php"><img height="150" src="<?php echo $getsetting['settings_logo'] ?>" alt="logo" class="logo img-responsive"></a>
					</div>

					
					<?php if (!isset($_SESSION['user_email'])) { ?>
						<div class="col-md-8">
							<div class="pushright">
								<div class="top">
									<a href="#" id="reg" class="btn btn-default btn-dark">Login<span>-- Or --</span>Register</a>
									<div class="regwrap">
										<div class="row">
											<div class="col-md-6 regform">
												<div class="title-widget-bg">
													<div class="title-widget">Login</div>
												</div>

												<form action="nedmin/netting/operation.php" role="form" method="POST">
													<div class="form-group">
														<input type="text" class="form-control" id="user_email" name="user_email" placeholder="Email Address">
													</div>
													<div class="form-group">
														<input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password">
													</div>
													<div class="form-group">
														<button name="userlogin" id="userlogin" class="btn btn-default btn-red btn-sm">Sign In</button>
													</div>
													<div class="form-group">
														
														<div class="title"><a href="#"><h6><strong><u>Forget Password?</u></strong></h6></a></div>
														
													</div>
												</form>

											</div>
											<div class="col-md-6">
												<div class="title-widget-bg">
													<div class="title-widget">Register</div>
												</div>
												<p>
													New User? By creating an account you will be able to shop faster, be up to date on an order's status...
												</p>
												<a href="register"><button class="btn btn-default btn-yellow">Register Now</button></a>
											</div>
										</div>
									</div>
									<div class="srch-wrap">
										<a href="#" id="srch" class="btn btn-default btn-search"><i class="fa fa-search"></i></a>
									</div>
									<div class="srchwrap">
										<div class="row">
											<div class="col-md-12">
												<form action="search.php" method="POST" class="form-horizontal" role="form">
													<div class="form-group">
														<!-- <label for="search" class="col-sm-2 control-label">Search</label> -->
														<button name="search" type="submit" class="btn btn-default btn-xs">Search</button>
														<div class="col-sm-10">
															<input type="text" class="form-control" minlength="2" name="searchfor" id="searchfor">
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


					<?php }else{ ?>

						<div class="col-md-8">
							<div class="pushright">
								<div class="top">
									<a id="reg" style="pointer-events: none" class="btn btn-default btn-dark">Welcome<span> </span><?php echo $getuser['user_fullname']; ?></a>

									<div class="srch-wrap">
										<a href="#" id="srch" class="btn btn-default btn-search"><i class="fa fa-search"></i></a>
									</div>
									<div class="srchwrap">
										<div class="row">
											<div class="col-md-12">
												<form action="search.php" method="POST" class="form-horizontal" role="form">
													<div class="form-group">
														<!-- <label for="search" class="col-sm-2 control-label">Search</label> -->
														<button name="search" type="submit" class="btn btn-default btn-xs">Search</button>
														<div class="col-sm-10">
															<input type="text" class="form-control"  minlength="2" name="searchfor" id="searchfor">
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="dashed"></div>
		</div><!--Header -->
		<div class="main-nav"><!--end main-nav -->
			<div class="navbar navbar-default navbar-static-top">
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="navbar-collapse collapse">
								<ul class="nav navbar-nav">
									<li><a href="index.php" class="active">Home</a><div class="curve"></div></li>
									
									<?php 

									$findmenu=$db->prepare("SELECT * FROM menu WHERE menu_status=:status ORDER BY menu_index");
									$findmenu->execute(array(
										'status'=>1
									));

									while($getmenu=$findmenu->fetch(PDO::FETCH_ASSOC)) {

										?>


										<li><a href="

											<?php if(!empty($getmenu['menu_url'])){

												echo $getmenu['menu_url'];

												}else{

													echo "page-".seo($getmenu['menu_name']);

												} ?>

												"><?php echo $getmenu['menu_name']; ?></a></li>

											<?php } ?>

										</ul>
									</div>
								</div>


								<?php 
								$user_id = @$getuser['user_id'];

								$findcart=$db->prepare("SELECT * FROM cart WHERE user_id=:id");
								$findcart->execute(array(

									'id'=>$user_id
								));

								$totalprice = 0;

								while ($getcart=$findcart->fetch(PDO::FETCH_ASSOC)) { 

									$product_id = $getcart['product_id'];

									$findproduct=$db->prepare("SELECT * FROM product WHERE product_id=:id");
									$findproduct->execute(array(

										'id'=>$product_id
									));

									$getproduct=$findproduct->fetch(PDO::FETCH_ASSOC);

									$totalprice += $getproduct['product_price']*$getcart['product_amount'];

								} ?>



								<div class="col-md-2 machart">
									<button id="popcart" class="btn btn-default btn-chart btn-sm "><span class="mychart">Cart</span>|<span class="allprice"><?php echo $totalprice." ₺" ?></span></button>
									<?php if ($totalprice!=0) {?>
										<div class="popcart">
											<table class="table table-condensed popcart-inner">
												<tbody>

													<?php 
													$user_id = $getuser['user_id'];

													$findcart=$db->prepare("SELECT * FROM cart WHERE user_id=:id");
													$findcart->execute(array(

														'id'=>$user_id
													));

													$totalprice = 0;

													while ($getcart=$findcart->fetch(PDO::FETCH_ASSOC)) { 

														$product_id = $getcart['product_id'];

														$findproduct=$db->prepare("SELECT * FROM product WHERE product_id=:id");
														$findproduct->execute(array(

															'id'=>$product_id
														));

														$getproduct=$findproduct->fetch(PDO::FETCH_ASSOC);

														$totalprice += $getproduct['product_price']*$getcart['product_amount'];

														$findimage=$db->prepare("SELECT * FROM product_img WHERE product_id=:id ORDER BY product_img_id DESC");

														$findimage->execute(array(
															'id'=>$product_id
														));

														$getimage=$findimage->fetch(PDO::FETCH_ASSOC);

														?>

														<tr>
															<td>
																<a href="product-<?php echo $getproduct['product_seourl']."-".$getproduct['product_id'] ?>"><img src="<?php echo $getimage['product_img_path'] ?>" alt="" class="img-responsive"></a>
															</td>
															<td><a href="product-<?php echo $getproduct['product_seourl']."-".$getproduct['product_id'] ?>"><?php echo $getproduct['product_name'] ?></a></td>
															<td><?php echo $getcart['product_amount']." X" ?></td>
															<td><?php echo $getproduct['product_price']*$getcart['product_amount']." ₺" ?></td>
															<td><a href="nedmin/netting/operation.php?cart_id=<?php echo $getcart['cart_id'] ?>&deletecart=true&turnback_url=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];  ?>"><i class="fa fa-times-circle fa-2x"></i></a></td>
														</tr>

													<?php } ?>

												</tbody>
											</table>
											<br>
											<div class="btn-popcart">
												<a href="cart.php" class="btn btn-default btn-red btn-sm">Go to Chart</a>
											</div>
											<div class="popcart-tot">
												<p>
													Total<br>
													<span><?php echo $totalprice." ₺" ?></span>
												</p>
											</div>
											<div class="clearfix"></div>
										</div>
									<?php } ?>
								</div>
								<!--small-nav -->
								<?php 

								if (isset($_SESSION['user_email'])) { ?>


									<ul class="small-menu">
										<li><a href="myaccount" class="myacc">My Account</a></li>
										<li><a href="cart" class="myshop">Shopping Chart</a></li>
										<li><a href="logout.php" class="mycheck">Logout</a></li>
									</ul>

								<?php }elseif (isset($_GET['status'])) {
									if ($_GET['status']=='password_error') { 

										$message = "User email or password is not correct!";
										echo "<script type='text/javascript'>alert('$message');</script>";

										?>


										<!-- <div align="right">
											<div class="alert alert-danger"><span>User <strong>email</strong> or <strong>password</strong> is not correct</span></div>
										</div> -->

									<?php }
								} ?>
								<!--small-nav -->
							</div>
						</div>
					</div>
	</div><!--end main-nav -->