<?php include 'header.php'; ?>



<div class="container">


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

					<?php }
				}?>

				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="text" class="form-control" id="user_fullname" name="user_fullname" placeholder="Name">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email">
					</div>
				</div>

				<div class="title-bg">
					<div class="title">Account Details</div>
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
				</div>
				<button class="btn btn-default btn-red" name="saveuser" id="saveuser">Register</button>
				
			</div>
			

		</div>
	</form>
	<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>