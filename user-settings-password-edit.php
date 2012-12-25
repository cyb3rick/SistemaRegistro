<?php include 'core/init.php' ?>
<?php 

if (isset($_POST['submit_password'])) {
	$old_pass = $_POST['old_pass']; 
	$new_pass = $_POST['new_pass']; 
	$new_pass_conf = $_POST['new_pass_conf'];	
	
	if (empty($old_pass) || empty($new_pass) || empty($new_pass_conf)) {
		header("Location: user-settings.php?u=epass");
		exit();
	}
	
	$old_pass = md5($_POST['old_pass']); // sanitized in update_user_password()
	$new_pass = md5($_POST['new_pass']);
	$new_pass_conf = md5($_POST['new_pass_conf']);
	
	if ($old_pass != $user_data['password']) {
		header("Location: user-settings.php?u=opass");
		exit();
	}
	else if ($new_pass != $new_pass_conf) {
		header("Location: user-settings.php?u=cpass");
		exit();
	}

	// update first and last name
	update_user_password($user_data['username'], $new_pass);
	
	header("Location: user-settings.php?u=pass");
	exit;
}

?>