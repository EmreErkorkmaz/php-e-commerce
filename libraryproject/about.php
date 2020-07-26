<?php 

include 'header.php'; 

$findabout=$db->prepare("SELECT * FROM about WHERE about_id=:id");
$findabout->execute(array(
	'id'=>0
));

$getabout=$findabout->fetch(PDO::FETCH_ASSOC);

?>



<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-4">
							<div class="bigtitle">About</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title">Who are we?</div>
			</div>

			<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $getabout['about_video'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

			<div class="title-bg">
				<div class="title"><?php echo $getabout['about_title']; ?></div>
			</div>
			<div class="page-content">
				<p>
					<?php echo $getabout['about_content']; ?>
				</p>
			</div>

			<div class="title-bg">
				<div class="title">Our Vision</div>
			</div>
			<blockquote><?php echo $getabout['about_vision']; ?></blockquote>

			<div class="title-bg">
				<div class="title">Our Mission</div>
			</div>
			<blockquote><?php echo $getabout['about_mission']; ?></blockquote>

		</div>
		
		<!-- sidebar location -->
		<?php include 'sidebar.php'; ?>

	</div>
	<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>