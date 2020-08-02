<?php 

include 'header.php'; 








if (isset($_GET['sef'])) {


	$findcategorycount=$db->prepare("SELECT * FROM category WHERE category_seourl=:seourl");
	$findcategorycount->execute(array(
		'seourl'=>$_GET['sef']
	));

	$getcategorycount=$findcategorycount->fetch(PDO::FETCH_ASSOC);



	//$category_id çalışıyor
	$category_id = $getcategorycount['category_id'];
	


	

	$findproductcount=$db->prepare("SELECT * FROM product WHERE category_id=:id ORDER BY product_front DESC");
	$findproductcount->execute(array(
		'id' => $category_id
	));

	$totalcount_context=$findproductcount->rowCount();

}else{


	$findproductcount=$db->prepare("SELECT * FROM product ORDER BY product_front DESC");
	$findproductcount->execute();


	$totalcount_context=$findproductcount->rowCount();


}


$page_limit = 6;

$pagecount = ceil($totalcount_context/$page_limit);

if (isset($_GET['page_number'])) {
	$page_number = $_GET['page_number'] - 1;
	$pagestartindex = $page_number*$page_limit;
	
}else{
	$pagestartindex = 0*$page_limit;
}


if (isset($_GET['sef'])) {


	$findcategory=$db->prepare("SELECT * FROM category WHERE category_seourl=:seourl");
	$findcategory->execute(array(
		'seourl'=>$_GET['sef']
	));

	$getcategory=$findcategory->fetch(PDO::FETCH_ASSOC);

	$category_id = $getcategory['category_id'];


	
	$findproduct=$db->prepare("SELECT * FROM product WHERE category_id=:id ORDER BY product_front DESC LIMIT $pagestartindex,$page_limit");
	$findproduct->execute(array(
		'id' => $category_id
	));

}
else{


	$findproduct=$db->prepare("SELECT * FROM product ORDER BY product_front DESC LIMIT $pagestartindex,$page_limit");
	$findproduct->execute();
}


?>



<div class="container">

	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title">

					Category - 
					<?php 
					if (isset($_GET['sef'])){
						$sef = $_GET['sef']; 
						$title = explode("-", $sef);
						foreach ($title as $key) {
							echo ucfirst($key)." ";
						}


					}else{echo "All products";} ?>

				</div>
				<div class="title-nav">
					<a href="category.php"><i class="fa fa-th-large"></i>Grid</a>
					<a href="categorylist.php"><i class="fa fa-bars"></i>List</a>
				</div>
			</div>


			

			<div class="row prdct"><!--Products-->

				<?php 

				if (isset($_GET['sef']) || $totalcount_context==0) { ?>

					<br><br><br>

					<center><div class="title">No available content at this moment. Check out later...</div></center>

					
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

				<?php if($pagecount!=1){ ?>

				<nav style="margin-left: 50%" aria-label="Page navigation example">
					<ul class="pagination">

						<?php for ($i=1; $i <= $pagecount; $i++) {  ?>

							<!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->
							<?php if(isset($_GET['sef'])){ ?>

								<li class="page-item"><a class="page-link" href="category-<?=seo($getcategorycount['category_name'])?>?page_number=<?php echo $i ?>"><?php echo $i ?></a></li> 

							<?php }else{ ?>

								<li class="page-item"><a class="page-link" href="category?page_number=<?php echo $i ?>"><?php echo $i ?></a></li>

							<?php } ?>
							<!-- <li class="page-item"><a class="page-link" href="category.php?page_number=2">2</a></li> -->
							<!-- <li class="page-item"><a class="page-link" href="#">3</a></li> -->
							<!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->

						<?php } ?>
					</ul>
				</nav>

			<?php } ?>







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