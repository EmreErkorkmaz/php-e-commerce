<?php

include 'header.php';

$findabout=$db->prepare("SELECT * FROM about WHERE about_id=:id");
$findabout->execute(array(
	'id'=>0
));

$getabout=$findabout->fetch(PDO::FETCH_ASSOC);

?>

?>

<div class="container">

	<div class="clearfix"></div>
	<div class="lines"></div>

	<!-- slider.php -->
	<?php include 'slider.php'; ?>



</div>
<div class="f-widget featpro">
	<div class="container">
		<div class="title-widget-bg">
			<div class="title-widget">Featured Products</div>
			<div class="carousel-nav">
				<a class="prev"></a>
				<a class="next"></a>
			</div>
		</div>
		<div id="product-carousel" class="owl-carousel owl-theme">

			<?php 


			

			$lowerfindproduct=$db->prepare("SELECT * FROM product WHERE product_front=:product_front ORDER BY rand() DESC LIMIT 3");
			$lowerfindproduct->execute(array(
				'product_front' => 1
			));


			while($lowergetproduct=$lowerfindproduct->fetch(PDO::FETCH_ASSOC)) {

				$findimage=$db->prepare("SELECT * FROM product_img WHERE product_id=:id ORDER BY product_img_id DESC");

				$findimage->execute(array(
					'id'=>$lowergetproduct['product_id']
				));

				$getimage=$findimage->fetch(PDO::FETCH_ASSOC);

				?>


				<div class="item">
					<div class="productwrap">
						<div class="pr-img">
							<?php 
							if($lowergetproduct['product_front'] == 1)
								{ ?> 
									<div class="hot"></div> 
								<?php } ?>
								<a href="product-<?=seo($lowergetproduct['product_name']).'-'.$lowergetproduct['product_id']?>"><img style="max-width: auto; height: 130px; display: block; margin-left: auto; margin-right: auto;" src="<?php echo $getimage['product_img_path'] ?>" alt="" class="img-responsive"></a>
								<div class="pricetag blue"><div class="inner"><span><?php echo $lowergetproduct['product_price']." ₺"; ?></span></div></div>
							</div>
							<span class="smalltitle"><a href="product-<?=seo($lowergetproduct['product_name']).'-'.$lowergetproduct['product_id']?>"><?php echo $lowergetproduct['product_name']; ?></a></span>
							<span class="smalldesc">Item no.: <?php echo $lowergetproduct['product_id']; ?></span>
						</div>
					</div>

				<?php } ?>
				
				
				
				
				
			</div>
		</div>
	</div>
	
	
	
	<div class="container">
		<div class="row">
			<div class="col-md-9"><!--Main content-->
				<div class="title-bg">
					<div class="title"><?php echo $getabout['about_title']; ?></div>
				</div>
				<p class="ct">

					
					<?php 


					echo substr($getabout['about_content'], 0, 570);
					if (strlen($getabout['about_content'])>500) {
						echo "...";
					}


					?>

				</p>
				<a href="about.php" class="btn btn-default btn-red btn-sm">Read More</a>
				
				<div class="title-bg">
					<div class="title">Lastest Products</div>
				</div>
				<div class="row prdct"><!--Products-->

					<?php 




					$lowerfindproduct=$db->prepare("SELECT * FROM product ORDER BY product_date DESC LIMIT 3");
					$lowerfindproduct->execute(array(

					));


					while($lowergetproduct=$lowerfindproduct->fetch(PDO::FETCH_ASSOC)) {

						$findimage=$db->prepare("SELECT * FROM product_img WHERE product_id=:id ORDER BY product_img_id DESC");

						$findimage->execute(array(
							'id'=>$lowergetproduct['product_id']
						));

						$getimage=$findimage->fetch(PDO::FETCH_ASSOC);

						?>



						<div class="col-md-4">
							<div class="productwrap">
								<div class="pr-img">
									<a href="product-<?=seo($lowergetproduct['product_name']).'-'.$lowergetproduct['product_id']?>"><img style="max-width: auto; height: 130px; display: block; margin-left: auto; margin-right: auto;" src="<?php echo $getimage['product_img_path'] ?>" alt="" class="img-responsive"></a>
									<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice"><?php echo $lowergetproduct['product_price']*1.5." ₺" ?></span><?php echo $lowergetproduct['product_price']." ₺" ?></span></div></div>
								</div>
								<span class="smalltitle"><a href="product-<?=seo($lowergetproduct['product_name']).'-'.$lowergetproduct['product_id']?>"><?php echo $lowergetproduct['product_name'] ?></a></span>
								<span class="smalldesc">Item no.: <?php echo $lowergetproduct['product_id'] ?></span>
							</div>
						</div>

					<?php } ?>
					
				</div><!--Products-->
				<div class="spacer"></div>
			</div><!--Main content-->
			
			<?php include 'sidebar.php'; ?>

		</div>
	</div>
	
	
	<?php 

	include 'footer.php';

	?>