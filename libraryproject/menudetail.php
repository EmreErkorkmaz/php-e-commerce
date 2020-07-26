<?php 

include 'header.php'; 


$findmenu=$db->prepare("SELECT * FROM menu WHERE menu_seourl=:sef");
$findmenu->execute(array(
	'sef'=>$_GET['sef']
));

$getmenu=$findmenu->fetch(PDO::FETCH_ASSOC);

?>



<div class="container">
	
	<div class="row">
		
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title"><?php echo $getmenu['menu_name'] ?></div>
			</div>

			
			<div class="page-content">
				<p>
					<?php echo $getmenu['menu_detail']; ?>
				</p>
			</div>

			

		</div>
		
		<!-- sidebar location -->
		<?php include 'sidebar.php'; ?>

	</div>
	<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>