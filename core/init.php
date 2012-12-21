<?php

session_start();

require 'database/connect.php';
require 'functions/users.php';
//require 'functions/businesses.php';
//require 'functions/categories.php';
//require 'functions/sales.php';

if (logged_in()) {
	$session_username = $_SESSION['username'];
	
	/* $user_data is an array with elements 
	 * specified in user_data() parameters. 
	 * This array is accessible through out 
	 * all pages. */
	$user_data = 
		user_data($session_username, 'username', 'password', 'first_name', 'last_name', 'email');
		
	//$business_id = business_id_from_username($session_username);
	
	/* $business_data is an array with elements 
	 * specified in user_data() parameters. 
	 * This array is accessible through out 
	 * all pages. */
	 //$business_data = business_data($business_id, 'name', 'phone', 'profile_pic_url', 'shopper_url', 'street_number', 'city', 'zipcode', 'openning_time', 'closing_time', 'username', 'category_id');
	
}

$errors =  array(); // for login errors!

?>
