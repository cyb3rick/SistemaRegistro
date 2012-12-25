<?php include 'core/init.php' ?>
<?php 

if (isset($_POST['submit_fullname'])) {
	$first_name = $_POST['first_name']; // sanitized in update_user_fullname()
	$last_name = $_POST['last_name']; // sanitized in update_user_fullname()
	
	update_user_fullname($user_data['username'], $first_name, $last_name);
	
	header("Location: user-settings.php?u=name");
	exit;
}

?>