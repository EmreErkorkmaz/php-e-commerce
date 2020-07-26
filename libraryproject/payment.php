<?php include 'header.php' ?>

<div class="container">

	<div class="clearfix"></div>
	<div class="lines"></div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			
		</div>
	</div>
	<div class="title-bg">
		<div class="title">Payment Page</div>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered chart">
			<thead>
				<tr>
					<th>Product Image</th>
					<th>Product Name</th>
					<th>Product Code</th>
					<th>Amount</th>
					<th>Total Price</th>
				</tr>
			</thead>
			<tbody>


				<?php 

				$total=0;


				$user_id=$getuser['user_id'];
				$findcart=$db->prepare("SELECT * FROM cart where user_id=:id");
				$findcart->execute(array(
					'id' => $user_id
				));

				while($getcart=$findcart->fetch(PDO::FETCH_ASSOC)) {

					$product_id=$getcart['product_id'];
					$findproduct=$db->prepare("SELECT * FROM product where product_id=:product_id");
					$findproduct->execute(array(
						'product_id' => $product_id
					));

					$getproduct=$findproduct->fetch(PDO::FETCH_ASSOC);
					$total+=$getproduct['product_price']*$getcart['product_amount'];



					$findimage=$db->prepare("SELECT * FROM product_img WHERE product_id=:id ORDER BY product_img_id DESC");

					$findimage->execute(array(
						'id'=>$product_id
					));

					$getimage=$findimage->fetch(PDO::FETCH_ASSOC);



					?>


					


					<tr>
						<td><img src="<?php echo $getimage['product_img_path'] ?>" style="max-width: auto; height: 100px; display: block; margin-left: auto; margin-right: auto;"  alt=""></td>
						<td><?php echo $getproduct['product_name'] ?></td>
						<td><?php echo $getproduct['product_id'] ?></td>
						<td><form><?php echo $getcart['product_amount'] ?></form></td>
						<td><?php echo $getproduct['product_price'] ?></td>
					</tr>
				<?php } ?>

			</tbody>
		</table>
	</div>
	<div class="row">
		<div class="col-md-6">


		</div>
		<div class="col-md-3 col-md-offset-3">
			<div class="subtotal-wrap">
					<!--<div class="subtotal">
						<<p>Toplam Fiyat : $26.00</p>
						<p>Vat 17% : $54.00</p>
					</div>-->
					<div style="border-style: solid; border-radius: 10px; margin: 10px; padding: 10px; background: white;" class="total">Total Cost : <span class="bigprice"><?php echo $total ?> ₺</span></div>
					<div class="clearfix"></div>
					<!-- <a href="" class="btn btn-default btn-yellow">Ödeme Sayfası</a> -->
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="tab-review">
			<ul id="myTab" class="nav nav-tabs shop-tab">

				<li class="active"><a href="#desc" data-toggle="tab">Credit Card</a></li>
				<li><a href="#rev" data-toggle="tab">Bank Transfer </a></li>
			</ul>




			<div id="myTabContent" class="tab-content shop-tab-ct">
				

				<div class="tab-pane fade active in" id="desc">
					<p>
						Entegrasyon Tamamlanmadı.
					</p>
				</div>


				<div class="tab-pane fade " id="rev">

					<form action="nedmin/netting/operation.php" method="POST">

						<p>Ödeme yapacağınız hesap numarasını seçerek işlemi tamamlayınız.</p>


						<?php 

						

						$findbank=$db->prepare("SELECT * FROM bank");
						$findbank->execute();

						while($getbank=$findbank->fetch(PDO::FETCH_ASSOC)) { ?>


							<input type="radio" name="order_bank" value="<?php echo $getbank['bank_name'] ?>">
							<?php echo $getbank['bank_name']; echo " ";?>

							<br>




						<?php } ?>
						<input type="hidden" name="user_id" value="<?php echo $getuser['user_id'] ?>">

						<input type="hidden" name="order_total" value="<?php echo $total; ?>">


						<hr>
						<button class="btn btn-success" type="submit" name="addbankorder">Order Now!</button>

					</form>

				</div>


			</div>
		</div>
		<div class="spacer"></div>
	</div>

	<?php include 'footer.php' ?>