<?php 

include 'header.php';



?>



<div class="container">

	<div class="title-bg">
		<div class="title">Shopping Cart</div>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered chart">
			<thead>
				<tr>
					<th>Remove</th>
					<th>Image</th>
					<th>Name</th>
					<th>Item No.</th>
					<th>Quantity</th>
					<th>Unit Price</th>
					<th>Total</th>
				</tr>
			</thead>
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
						<td><a href="nedmin/netting/operation.php?cart_id=<?php echo $getcart['cart_id'] ?>&deletecart=true&turnback_url=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];  ?>"><i class="fa fa-times-circle fa-2x"></i></a></td>
						<td><img src="<?php echo $getimage['product_img_path'] ?>" style="max-width: auto; height: 100px; display: block; margin-left: auto; margin-right: auto;"  alt=""></td>
						<td><?php echo $getproduct['product_name']; ?></td>
						<td><?php echo $getproduct['product_id']; ?></td>
						<td><form><input type="number" disabled="" min="0" max="1000" value="<?php echo $getcart['product_amount'] ?>" class="form-control quantity"></form></td>
						<td><?php echo $getproduct['product_price']." ₺"; ?></td>
						<td><?php echo $getproduct['product_price']*$getcart['product_amount']." ₺"; ?></td>
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
				
				<div class="total">Total : <span class="bigprice"><?php echo $totalprice." ₺" ?></span></div>
				<!-- <a href="" class="btn btn-default btn-red btn-sm">Checkout</a>
					<a href="" class="btn btn-default btn-red btn-sm">Update</a> -->
					<div class="clearfix"></div>
					<a href="payment.php" class="btn btn-default btn-yellow">Complete Payment</a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="spacer"></div>
	</div>
	
	<?php include 'footer.php'; ?>