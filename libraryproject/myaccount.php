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
				<div class="title-bg">
					<div class="title">Personal Details</div>
				</div>


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
						
					<?php }
				}?>


				<input type="hidden" name="user_id" id="user_id" value="<?php echo $getuser['user_id'] ?>">
				

				<div class="form-group dob">

					<div class="col-sm-12">
						<input type="text" class="form-control" style="pointer-events: none" id="user_fullname" name="user_fullname" readonly="readonly" value="<?php echo($getuser['user_email']) ?>">
					</div>
				</div>


				<div class="title-bg">
					<div class="title"><h4>Name Surname</h4></div>
				</div>

				<div class="form-group">
					<div class="col-sm-12">
						<input type="text" class="form-control" id="user_fullname" name="user_fullname" placeholder="Name Surname" value="<?php echo $getuser['user_fullname'] ?>">
					</div>
				</div>

				
				<div class="title-bg">
					<div class="title"><h4>Phone Number</h4></div>
				</div>

				<div class="form-group">
					<div class="col-sm-12">
						<input type="text" class="form-control" id="user_phone" name="user_phone" placeholder="Phone Number" value="<?php echo $getuser['user_phone'] ?>">
					</div>
				</div>

				

				<div class="form-group">
					<div class="col-sm-8">
						<div class="title-bg">
							<div class="title"><h4>Address</h4></div>
						</div>
						<textarea type="text" style="resize: none; height: 140px;" class="form-control" id="user_address" name="user_address" placeholder="Address"> <?php echo $getuser['user_address'] ?></textarea>
					</div>
					<div class="col-sm-4">
						<div class="title-bg">
							<div class="title"><h4>City</h4></div>
						</div>
						<input type="text" class="form-control" id="user_city" name="user_city" placeholder="City" value="<?php echo $getuser['user_city'] ?>">
						<div class="title-bg">
							<div class="title"><h4>District</h4></div>
						</div>
						<input type="text" class="form-control" id="user_district" name="user_district" placeholder="District" value="<?php echo $getuser['user_district'] ?>">

					</div>
				</div>

				

				

				<!-- <div class="title-bg">
					<div class="title"><h4>Password</h4></div>
				</div>
				<div class="form-group dob">

					<div class="col-sm-12">
						<input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password">
					</div>
				</div>


				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="password" class="form-control" id="user_password_confirm" name="user_password_confirm" placeholder="Confirm Password">
					</div>
					<div class="col-sm-6">

					</div>
				</div> -->
				<div class="col-md-3">
					<button class="btn btn-default btn-red" name="updateuserinfo" id="updateuserinfo">Update Info</button>
					
				</div>
				<div align="right" style="text-align: center;" class="col-md-4">
					<a href="updatepassword.php"><u>Change Password</u></a>
				</div>
			</div>

		</div>
	</form>
	<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>