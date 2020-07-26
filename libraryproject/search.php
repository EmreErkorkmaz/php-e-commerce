<?php 

include 'header.php'; 


if (isset($_POST['search'])) {



	$searchfor = $_POST['searchfor'];
	

	$findproduct=$db->prepare("SELECT * FROM product WHERE product_name LIKE ?  ORDER BY product_front DESC");
	$findproduct->execute(array("%$searchfor%"));

	$count=$findproduct->rowCount();

}else{

Header("Location:index.php?status=empty");
	

}





?>



<div class="container">

	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title">

					Here what we found about " <u>
					<?php 
					echo $_POST['searchfor']; ?></u>"

				</div>
				<div class="title-nav">
					<a href="category.php"><i class="fa fa-th-large"></i>Grid</a>
					<a href="categorylist.php"><i class="fa fa-bars"></i>List</a>
				</div>
			</div>


			

			<div class="row prdct"><!--Products-->

				<?php 

				if (!isset($count) || $count==0) { ?>

					<br><br><br>

					<center><div class="title">Search completed. There is no available content.</div></center>

					
				<?php }

				while($getproduct=$findproduct->fetch(PDO::FETCH_ASSOC)) { 

					$findimage=$db->prepare("SELECT * FROM product_img WHERE product_id=:id ORDER BY product_img_id DESC");

					$findimage->execute(array(
						'id'=>$getproduct['product_id']
					));

					$getimage=$findimage->fetch(PDO::FETCH_ASSOC);

					?>
					<div class="col-md-4">
						<div class="productwrap">
							<div class="pr-img">

								<?php 
								if($getproduct['product_front'] == 1)
									{ ?> 
										<div class="hot"></div> 
									<?php } ?>

									<a href="product-<?=seo($getproduct['product_name']).'-'.$getproduct['product_id']?>">
										<?php if(!empty($getimage['product_img_path'])) {?>

											<img style="max-width: auto; height: 130px; display: block; margin-left: auto; margin-right: auto;" src="<?php echo $getimage['product_img_path'] ?>" alt="" class="img-responsive">

										<?php }else{ ?>

											<img src="images\sample-3.jpg" alt="" class="img-responsive">

										<?php } ?>

									</a>
									<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice"><?php echo $getproduct['product_price']*1.50.' ₺'; ?></span><?php echo $getproduct['product_price']." ₺" ?></span></div></div>
								</div>
								<span class="smalltitle"><a href="#"><?php echo $getproduct['product_name'] ?></a></span>
								<span class="smalldesc">Item no.: <?php echo $getproduct['product_id'] ?></span>
							</div>
						</div>

					<?php  } ?>
				</div>







				<!--Products-->

				<!--pagination-->
				<!-- <ul class="pagination shop-pag">
					<li><a href="#"><i class="fa fa-caret-left"></i></a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#"><i class="fa fa-caret-right"></i></a></li>
				</ul> -->
				<!--pagination-->

			</div>
			<?php include 'sidebar.php'; ?>
		</div>
		<div class="spacer"></div>
	</div>
	
	<?php include 'footer.php'; ?>