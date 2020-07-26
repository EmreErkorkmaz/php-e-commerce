<?php 

include 'header.php';


if (isset($_GET['sef'])) {


	$findproduct=$db->prepare("SELECT * FROM product WHERE product_id=:id");
	$findproduct->execute(array(
		
		'id'=>$_GET['product_id']
	));

	$getproduct=$findproduct->fetch(PDO::FETCH_ASSOC);

	if ($findproduct->rowCount()==0) {
		header("Location:index.php");
	}


	
	

}

if (isset($_GET['status']) && $_GET['status']=="ok") {?>
	
	<script type="text/javascript">
		alert("Comment sent successfuly");
	</script>

<?php } ?>



<div class="container">
	
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title"><?php echo $getproduct['product_name']; ?></div>
			</div>
			<div class="row">
				<div class="col-md-6">

					<?php 

					$findimage=$db->prepare("SELECT * FROM product_img WHERE product_id=:id ORDER BY product_img_id DESC");

					$findimage->execute(array(
						'id'=>$getproduct['product_id']
					));
					$number = 0;
					while($getimage=$findimage->fetch(PDO::FETCH_ASSOC)){
						if ($number == 0) { $number++ ?>
							
							<div class="dt-img">
								<div class="detpricetag"><div class="inner"><?php echo $getproduct['product_price']." ₺"; ?></div></div>
								<a class="fancybox" href="<?php echo $getimage['product_img_path'] ?>" data-fancybox-group="gallery" ><img src="<?php echo $getimage['product_img_path'] ?>" alt="" class="img-responsive"></a>
							</div>

						<?php }else{
							?>

							
							<div class="thumb-img">
								<a class="fancybox" href="<?php echo $getimage['product_img_path'] ?>" data-fancybox-group="gallery" ><img style="max-width: auto; height: 130px; display: block; margin-left: auto; margin-right: auto;" src="<?php echo $getimage['product_img_path'] ?>" alt="" class="img-responsive"></a>
							</div>

						<?php }
					} ?>
					
				</div>
				<div class="col-md-6 det-desc">
					<div class="productdata">
						<div class="infospan">Model <span>PT - 3</span></div>
						<div class="infospan">Item no <span><?php echo $getproduct['product_id']; ?></span></div>
						<div class="infospan">Price <span><?php echo $getproduct['product_price']." ₺"; ?></span></div>
						
						<div class="clearfix"></div>
						<div class="dash"></div>

						<br>

						<form action="nedmin/netting/operation.php" method="POST">

							<div class="form-group">
								<label for="qty" class="col-sm-2 control-label">Amount: </label>
								<div class="col-sm-4">

									<input class="form-control" name="product_amount" type="number" value="1" min="1" max="10">

									<input type="hidden" name="user_id" value="<?php echo $getuser['user_id'] ?>">

									<input type="hidden" name="product_id" value="<?php echo $getproduct['product_id'] ?>">


								</div>
								<div class="col-sm-4">
									<button type="submit" name="addcart" class="btn btn-default btn-red btn-sm">
										<span class="addchart">Add To Chart</span>
									</button>
								</div>
								<div class="clearfix"></div>
							</div>
						</form>

						<div class="sharing">
							<!-- <div class="share-bt">
								<div class="addthis_toolbox addthis_default_style ">
									<a class="addthis_counter addthis_pill_style"></a>
								</div>
								<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f0d0827271d1c3b"></script>
								<div class="clearfix"></div>
							</div> -->
							<div class="avatock"><span>
								<?php 
								if ($getproduct['product_stock'] >= 1) {
									echo "In Stock: ".$getproduct['product_stock'];
								}else{
									echo "Coming Soon!";
								} ?>

							</span></div>
						</div>

					</div>
				</div>
			</div>

			<div class="tab-review">
				<ul id="myTab" class="nav nav-tabs shop-tab">

					<li 

					<?php if (empty($_GET['status'])) { ?>
						class="active"
					<?php } ?>

					><a href="#desc" data-toggle="tab">Description</a></li>
					<li 

					<?php if (isset($_GET['status'])) { ?>
						class="active"
					<?php }

					$user_id = $getuser['user_id'];
					$product_id = $getproduct['product_id'];

					$findcomment=$db->prepare("SELECT * FROM comments WHERE product_id=:product_id");
					$findcomment->execute(array(
						
						'product_id'=>$product_id
					));

					$commentnumber = $findcomment->rowCount();

					?>

					><a href="#rev" data-toggle="tab">Reviews (<?php echo $commentnumber ?>)</a></li>

				</ul>

				<div id="myTabContent" class="tab-content shop-tab-ct">
					<div class="tab-pane fade <?php if (empty($_GET['status'])) { ?>
						active in
						<?php } ?>" id="desc">
						<p>
							<?php echo $getproduct['product_detail']; ?>
						</p>
					</div>
					<div class="tab-pane fade <?php if (isset($_GET['status'])) { ?>
						active in
						<?php } ?>" id="rev">

						<?php 


						while ($getcomment=$findcomment->fetch(PDO::FETCH_ASSOC)) {	


							$user_id = $getcomment['user_id'];

							$findcommentuser=$db->prepare("SELECT * FROM user WHERE user_id=:user_id");
							$findcommentuser->execute(array(

								'user_id'=>$user_id
							));

							$getcommentuser=$findcommentuser->fetch(PDO::FETCH_ASSOC);

							?>


							<!-- comments -->
							<p class="dash">
								<span><?php echo $getcommentuser['user_fullname'] ?></span> (<?php echo $getcomment['comment_date'] ?>)<br><br>
								<?php echo $getcomment['comment_detail']; ?>
							</p>

						<?php } ?>

						<!-- comments -->
						
						<?php 

						if (isset($_SESSION['user_email'])) {?>
							
							<h4>Write Review</h4>
							<form action="nedmin/netting/operation.php" method="POST" role="form">

								<div class="form-group">
									<textarea style="resize: none;" class="form-control" id="text" name=comment_detail placeholder="Write comment here..."></textarea>
								</div>

								<input type="hidden" name="user_id" value="<?php echo $getuser['user_id'] ?>">

								<input type="hidden" name="product_id" value="<?php echo $getproduct['product_id'] ?>">


								<input type="hidden" name="product_url" value="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">

								<button type="submit" name="addcomment" class="btn btn-default btn-red btn-sm">Submit</button>
							</form>



						<?php }else{ ?>
							<form role="form">
								
								<div class="form-group">
									<textarea style="pointer-events: none; resize: none;" disabled=""  class="form-control"  id="text" placeholder="You must login first..."></textarea>
								</div>
								
								<button type="submit" disabled="" class="btn btn-default btn-red btn-sm">Submit</button>
							</form>
						<?php }	 ?>


						
						<!-- comments -->

					</div>
				</div>
			</div>

			<div id="title-bg">
				<div class="title">Related Products</div>
			</div>
			<div class="row prdct"><!--Products-->

				<?php 
				$category_id=$getproduct['category_id'];

				$lowerfindproduct=$db->prepare("SELECT * FROM product WHERE category_id=:id ORDER BY rand() DESC LIMIT 3");
				$lowerfindproduct->execute(array(
					'id' => $category_id
				));

				while($lowergetproduct=$lowerfindproduct->fetch(PDO::FETCH_ASSOC)) {

					?>

					<div class="col-md-4">
						<div class="productwrap">
							<div class="pr-img">

								<?php 
								if($lowergetproduct['product_front'] == 1)
									{ ?> 
										<div class="hot"></div> 
									<?php } ?>

									<a href="product-<?=seo($lowergetproduct['product_name']).'-'.$lowergetproduct['product_id']?>"><img src="images\sample-4.jpg" alt="" class="img-responsive"></a>
									<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice"><?php echo $lowergetproduct['product_price']*1.5." ₺"; ?></span><?php echo $lowergetproduct['product_price']." ₺"; ?></span></div></div>
								</div>
								<span class="smalltitle"><a href="product-<?=seo($lowergetproduct['product_name']).'-'.$lowergetproduct['product_id']?>"><?php echo $lowergetproduct['product_name']; ?></a></span>
								<span class="smalldesc">Item No: <?php echo $lowergetproduct['product_id']; ?></span>
							</div>
						</div>

					<?php } ?>

				</div><!--Products-->
				<div class="spacer"></div>
			</div><!--Main content-->

			<?php include 'sidebar.php'; ?>


		</div>
	</div>

	<?php include 'footer.php'; ?>