<?php 

include 'core/init.php';

if ( empty($_POST) === false ) {

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if (empty($username) === true || empty($password) === true) {
		$errors[] = 'Necesita entrar un nombre de usuario y contrase&#241;a.';
	}
	else if (user_exists($username) === false) {
		$errors[] = 'No existe este nombre de ususario.';
	}
	else if ( ($login = login($username, $password)) === false ) {
		$errors[] = 'No provey&#243; la contrase&#241;a correcta.';		
	}
	else {
		//echo $login;
		// user logged in successfully
		
		$_SESSION['username'] = $login;		
		header("Location: .");
		
	}	
	
	include 'template/header.php';
	include 'template/includes/widgets/login_modal.php';
	
	if (!empty($errors)) {
		
		echo "<h2>Disculpe pero...</h2>";
		echo "<div class='alert'>";
    	echo $errors[0] . "<button type='button' class='close' data-dismiss='alert'><button type='button' class='close' data-dismiss='alert'> <i class=icon-remove></i> </button>"; // print first logged error    	
    	echo "</div>";
    	echo "<a href='.' class='btn btn-large'><i class=\"icon-chevron-left icon-white\"></i> Back</a>";
	
	}
}

include 'template/footer.php';


?>
