
<?php

session_start();

require 'database/connect.php';
require 'functions/users.php';
require 'functions/students.php';
require 'functions/courses.php';
require 'functions/teachers.php';
require 'functions/sections.php';
require 'functions/utils.php';

if (logged_in()) {
	$session_username = $_SESSION['username'];
	
	/* $user_data is an array with elements 
	 * specified in user_data() parameters. 
	 * This array is accessible through out 
	 * all pages. */
	$user_data = 
		user_data($session_username, 'username', 'password', 'first_name', 'last_name', 'email');
		
}

$errors =  array(); // for login errors!

ob_start(); // enable output buffering to avoid header() function error.
			// further info: http://stackoverflow.com/questions/9707693/warning-cannot-modify-header-information-headers-already-sent-by-error

?>
