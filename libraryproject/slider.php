<div class="main-slide">
	<div id="sync1" class="owl-carousel">



		<?php 

		$findslider=$db->prepare("SELECT * FROM slider WHERE slider_status=:status ORDER BY slider_index LIMIT 5");
		$findslider->execute(array(
			'status'=>1
		));

		while($getslider=$findslider->fetch(PDO::FETCH_ASSOC)) { ?>

			<div class="item">
			<div class="slide-desc">
				<div class="inner">
					<h1><?php echo $getslider['slider_name']; ?></h1>
					<p>
						<?php echo $getslider['slider_content']; ?>
					</p>
					<!-- <button class="btn btn-default btn-red btn-lg">Add to cart</button> -->
				</div>
				<!-- <div class="inner">
					<div class="pro-pricetag big-deal">
						<div class="inner">
							<span class="oldprice">$314</span>
							<span>$199</span>
							<span class="ondeal">Best Deal</span>
						</div>
					</div>
				</div> -->
			</div>
			<div class="slide-type-1">
				<a href="<?php echo isset($getslider['slider_link']) ? $getslider['slider_link'] : "#"; ?>"><img height="378" src="<?php echo $getslider['slider_imgpath']; ?>" alt="" class="img-responsive"></a>
			</div>
		</div>

	<?php } ?>


		</div>
	</div>
	<div class="bar"></div>
	<div id="sync2" class="owl-carousel">


		

		<?php 

		$findslider=$db->prepare("SELECT * FROM slider WHERE slider_status=:status ORDER BY slider_index");
		$findslider->execute(array(
			'status'=>1
		));

		$number=0;

		while($getslider=$findslider->fetch(PDO::FETCH_ASSOC)) { $number++ ?>

			<div class="item">
			<div class="slide-type-1-sync border rounded-bottom">
				<h3><?php echo $number ?></h3>
			</div>
		</div>


	<?php } ?>
		
	</div>