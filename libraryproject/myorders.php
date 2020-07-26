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


	<form action="nedmin/netting/operation.php" method="POST" class="form-horizontal checkout" role="form">
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
								<th>Date</th>
								<th>Price</th>
								<th>Payment Type</th>
								<th>Status</th>
								<th>About Order</th>
								
							</tr>
						</thead>
						<tbody>

							<?php 
							$user_id=$getuser['user_id'];
							$findorder=$db->prepare("SELECT * FROM orders where user_id=:id");
							$findorder->execute(array(
								'id' => $user_id
							));

							while($getorder=$findorder->fetch(PDO::FETCH_ASSOC)) {?>
								<tr>

									<td><?php echo $getorder['order_id']; ?></td>
									<td><?php 

									$date = $getorder['order_date'];
									$date =  explode(" ", $date);

									echo $date[0];

										// echo $getorder['order_date']; 
									?></td>
									<td><?php echo $getorder['order_total']; ?></td>
									<td><?php echo $getorder['order_type']; ?></td>
									<td><?php 
									if ($getorder['order_type']==1) { ?>

										<button class="btn btn-success" style="pointer-events: none;">Confirmed</button>

									<?php }else{ ?>

										<button class="btn btn-warning" style="pointer-events: none;">Waiting...</button>

									<?php }

									?></td>

									<td><a class="btn btn-outline-dark" href="orderdetail.php?order_id=<?php echo $getorder['order_id'] ?>"><u>More...</u></a></td>
								</tr>

							<?php } ?>

						</tbody>
					</table>
				</div>


			</div>
			<div class="col-md-3"></div>

		</div>
	</div>
</form>
<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>