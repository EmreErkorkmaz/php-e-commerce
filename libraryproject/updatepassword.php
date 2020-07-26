<?php include 'header.php'; ?>



<div class="container">


	<?php 

	if (isset($_GET['status'])) {
		if ($_GET['status']=="confirmed") {?>

			<b style="color:green;">Operation Successful</b>

		<?php } elseif ($_GET['status']=="error") {?>

			<b style="color:red;">Operation Unsuccessful</b>

		<?php }


	}?>


	<form action="nedmin/netting/operation.php" class="form-horizontal checkout"  method="POST" role="form">
		<div class="row">
			<div class="col-md-6">
				


				<?php 


				if (isset($_GET['status'])) {
					
					if($_GET['status']=="password_error"){?>

						<div class="alert alert-danger">
							<strong>Confirmed Password is not matching</strong> Check your password please
						</div>




					<?php }elseif($_GET['status']=="password_short"){?>

						<div class="alert alert-danger">
							<strong>Password must be longer than 6 character</strong> Check your password please
						</div>

					<?php }elseif ($_GET['status']=="error") {?>

						<div class="alert alert-danger">
							<strong>System Error</strong> Try again later
						</div>
						
					<?php }elseif ($_GET['status']=="wrongpassword") { ?>

						<div class="alert alert-danger">
							<strong>Current Password is incorrect</strong> Try again
						</div>

					<?php }
				}?>


				<input type="hidden" name="user_id" id="user_id" value="<?php echo $getuser['user_id'] ?>">
				
				<div class="title-bg">
					<div class="title"><h4>Current Password</h4></div>
				</div>

				<div class="form-group dob">

					<div class="col-sm-12">
						<input type="password" class="form-control"  id="user_password" name="user_password" placeholder="Enter Current Password" >
					</div>
				</div>


				<div class="title-bg">
					<div class="title"><h4>New Password</h4></div>
				</div>

				<div class="form-group">
					<div class="col-sm-12">
						<input type="password" class="form-control" id="user_newpassword" name="user_newpassword" placeholder="New Password" >
					</div>
				</div>

				
				<div class="title-bg">
					<div class="title"><h4>Confirm New Password</h4></div>
				</div>

				<div class="form-group">
					<div class="col-sm-12">
						<input type="password" class="form-control" id="user_newpassword2" name="user_newpassword2" placeholder="Confirm New Password" >
					</div>
				</div>

				

				

				
				<button class="btn btn-default btn-red" name="updateuserpassword" id="updateuserpassword">Update Password</button>
			</div>

		</div>
	</form>
	<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>