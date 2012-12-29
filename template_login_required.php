<?php include 'core/init.php' ?>
<?php include 'template/header.php' ?>
<?php include 'template/includes/widgets/login_modal.php' ?> <!-- login modal -->

<?php 
	/* If not logged in, show login box. */
	if (!logged_in()) { include 'template/includes/widgets/login_box.php'; }
	else {
	?>
	<!-- show stats and the coolest search box -->
	
	
	<?php
	}
?>				

<?php include 'template/footer.php' ?>