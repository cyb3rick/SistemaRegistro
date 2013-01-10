<?php include 'core/init.php' ?>
<?php include 'template/header.php' ?>
<?php include 'template/includes/widgets/login_modal.php' ?> <!-- login modal -->

<?php

// TODO: IMPORTANT, various todo's to implement in this file.
if (isset($_GET['sec_id'])) {
	// sanitize and store sec_id
	$sec_id = mysql_real_escape_string($_GET['sec_id']);
	
	// TODO: check validity of input'd sec_id

	/* TODO: verify that no students have this section 'matriculada'.	
	if ( blah blah ) {
		$errors[] = 'Hay estudiantes tomando esta seccion.';
	}
	*/		
		
	// delete the section
	delete_section($sec_id);	
}
// go back to courses
header('Location: courses.php');

?>

<?php include 'template/footer.php' ?>