<?php 

include 'core/init.php';

if ( empty($_POST) === false ) {

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if (empty($username) === true || empty($password) === true) {
		$errors[] = 'You need to enter a username and password';
	}
	else if (user_exists($username) === false) {
		$errors[] = 'We can\'t find your username in our database. Did you register?';
	}
	else if ( ($login = login($username, $password)) === false ) {
		$errors[] = 'That username/password combination could NOT be found.';		
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
		
		echo "<h2>Sorry, we tried logging you in but...</h2>";
		echo "<div class='alert'>";
    	echo $errors[0] . "<button type='button' class='close' data-dismiss='alert'> × </button>"; // print first logged error    	
    	echo "</div>";
    	echo "<a href='.' class='btn btn-large'>~ Back home</a>";
	
	}
}

include 'template/footer.php';


?>
