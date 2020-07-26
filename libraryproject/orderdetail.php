<?php include 'header.php'; ?>



<?php 

if (isset($_GET['status'])) {
	if ($_GET['status']=="confirmed") { ?>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-title-wrap">
						<div class="page-title-inner" style="background-color: green;">
							<div class="row">
								<div style="color: white;" class="col-md-12">
									<div style="color: white;" class="bigtitle">Payment Completed!</div>
									<p>Ordered products will arrive in 20 days</p>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>


		<?php }
	} ?>


	<!-- <form action="nedmin/netting/operation.php" method="POST" class="form-horizontal checkout" role="form"> -->
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="title-bg">
					<div class="title">Order Details</div>
				</div>

				<div class="table-responsive">
					<table class="table table-bordered chart">
						<thead>
							<tr>
								
								<th>Order No</th>
								<th>Product Name</th>
								<th>Unit Price</th>
								<th>Total Price</th>
								<!-- <th>Status</th> -->
								
							</tr>
						</thead>
						<tbody>

							<?php 
							$user_id=$getuser['user_id'];
							$findorderdetail=$db->prepare("SELECT * FROM order_detail where order_id=:id");
							$findorderdetail->execute(array(
								'id' => $_GET['order_id']
							));

							while($getorderdetail=$findorderdetail->fetch(PDO::FETCH_ASSOC)) {

								$findproduct=$db->prepare("SELECT * FROM product where product_id=:id");
								$findproduct->execute(array(
									'id' => $getorderdetail['product_id']
								));	

								$getproduct=$findproduct->fetch(PDO::FETCH_ASSOC);


								?>




								<tr>

									<td><?php echo $getorderdetail['order_id']; ?></td>
									<td><?php echo $getproduct['product_name']; ?></td>
									<td><?php echo $getproduct['product_price']; ?></td>
									<td><?php echo $getorderdetail['product_amount']." X ".$getproduct['product_price']." = ".$getorderdetail['product_amount']*$getproduct['product_price']." ₺"; ?></td>

									<!-- <td><a href=""><button class="btn btn-primary btn-xs">More...</button></a></td> -->
								</tr>

							<?php } ?>

						</tbody>
					</table>
					<a href="myorders.php"><button class="btn btn-primary">Go to My Orders</button></a>
				</div>






			</div>
			<div class="col-md-3"></div>

		</div>
	</div>
<!-- </form> -->
<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>