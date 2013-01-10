<?php include 'core/init.php' ?>
<?php include 'template/header.php' ?>
<?php include 'template/includes/widgets/login_modal.php' ?> <!-- login modal -->

<?php

if (isset($_POST['add_submit'])) {

	// store input values
	$cid = $_POST['cid'];
	$tid = $_POST['tid'];
	$rid = $_POST['rid'];
	$did = $_POST['did'];
	
	// catch errors and save them in errors array (created in init.php file)
	// IMPORTANT: 333 is the value I assigned to the default dummy option in select elements
	if ($tid == 333) { 
		$errors[] = 'Usted no seleccionó ningún maestro.';
	}			
	if ($rid == 333) {
		$errors[] = 'Usted no seleccionó ningún salón.';		
	}
	if ( teacher_is_busy($tid, $did) ) {
		$errors[] = 'El maestro ya tiene asignado una sección para el día seleccionado.';
	}
	if ( room_is_occupied($rid, $did) ) {
		$errors[] = 'El salón ya tiene asignado una sección para el día seleccionado.';		
	}
		
	$sem_code = get_current_semester();
	$year = get_current_year();
	
	// if there are no errors, add section and go back to courses.php	
	if ( empty($errors) ) { // add section
		add_section($cid, $tid, $rid, $did, $sem_code, $year);
		header("Location: courses.php");
		exit();
	}
	else { // print errors
		echo "<h2>Intentamos añadir la sección pero...</h2>";
		echo "<div class='alert'>";
		echo $errors[0] . "<button type='button' class='close' data-dismiss='alert'> × </button>"; // print first logged error
		echo "</div>";
		echo "<a href=courses.php class='btn btn-large'><i class=\"icon-chevron-left icon-white\"></i> Atrás</a>";
	}	
}
else {
	// print error msg: cannot access script directly.	
}

?>

<?php include 'template/footer.php' ?>