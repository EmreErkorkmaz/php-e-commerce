<?php 

include 'header.php'; 


$findproduct=$db->prepare("SELECT * FROM product ORDER BY product_front DESC");
$findproduct->execute();





?>



<div class="container">
	
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title">Category - All products</div>
				<div class="title-nav">
					<a href="category.php"><i class="fa fa-th-large"></i>Grid</a>
					<a href="categorylist.php"><i class="fa fa-bars"></i>List</a>
					<div class="clearfix"></div>
				</div>
			</div>


			<?php 

			while($getproduct=$findproduct->fetch(PDO::FETCH_ASSOC)) { ?>

				<ul class="gridlist">
					<li class="gridlist-inner">
						<div class="white">
							<div class="row clearfix">
								<div class="col-md-4">
									<div class="pr-img">
										<?php if($getproduct['product_front'] == 1){ ?>
											<div class="hot"></div> 
										<?php } ?>
										<a href="#"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
									</div>
								</div>
								<div class="col-md-6">
									<div class="gridlisttitle"><?php echo $getproduct['product_name'] ?><span>Item no.: <?php echo $getproduct['product_id'] ?></span></div>
									<p class="gridlist-desc">
										<?php 
										if(strlen($getproduct['product_detail'])>=180){
											echo substr($getproduct['product_detail'], 0, 180)."...";
										}else{
											echo $getproduct['product_detail'];
										}
										?>
									</p>
								</div>
								<div class="col-md-2">
									<div class="gridlist-pricetag on-sale"><div class="inner"><span><span class="oldprice"><?php echo $getproduct['product_price']*1.50.' ₺'; ?></span><?php echo $getproduct['product_price'].' ₺'; ?></span></div></div>
								</div>
							</div>
						</div>
						<div class="gridlist-act">
							<a href="#"><span class="trolly">&nbsp;</span>Add to cart</a>
							<a href="#"><i class="fa fa-plus"></i>Add to compare list</a>
							<div class="clearfix"></div>
						</div>
					</li>


				</ul>

			<?php } ?>

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
	
	<?php include 'footer.php' ?>