<?php

function update_user_password($username, $password) {

	$password = mysql_real_escape_string($password);
	
	$query = mysql_query("UPDATE Users SET `password`='$password' WHERE `username`='$username';") or die("Sorry. Something went wrong while updating the database.");
	
	return true;
}


function user_has_business($username) {
	$query = mysql_query("SELECT COUNT(`username`) FROM `Businesses` WHERE `username`='$username';") or die(mysql_error());
	$result = mysql_fetch_array($query);
	return ($result[0] == 1) ? true : false;
}

function update_user_fullname($username, $first_name, $last_name) {
	$first_name = mysql_real_escape_string($first_name); // sanitize
	$last_name = mysql_real_escape_string($last_name); // sanitize	
	
	$query = mysql_query("UPDATE Users SET `first_name`='$first_name', `last_name`='$last_name' WHERE `username`='$username';") or die("Sorry. Something went wrong while updating the database.");
		
	/* This point is not reached if something wrong
		happens while updating the database */
	return true;
}


function user_data($username) {
	$data = array();
	$username = $username; // sanitize
	
	$func_num_args = func_num_args(); // returns number of args passed to user_data()
	$func_get_args = func_get_args(); // array with args
	
	if ($func_num_args > 1) {
		unset($func_get_args[0]); // remove first element from $func_get_args ($user_id)
		$fields = '`' . implode('`, `', $func_get_args) . '`';
						
		$query = mysql_query("SELECT $fields FROM `Users` WHERE `username` = '$username';");
		$data = mysql_fetch_array($query);
		
		return $data;
	}
}



/**
 * Returns true if user is logged in.
 * @return boolean
 * PRECONDITION: Requires database field 'user_id' (INT).
 */
function logged_in() {
	return (isset($_SESSION['username'])) ? true : false;	
}

function user_exists($username) {
	$username = mysql_real_escape_string($username); // sanitize
	$query = mysql_query("SELECT COUNT(`username`) FROM `Users` WHERE `username`='$username';") or die(mysql_error());
	$result = mysql_result($query,0);	
	return (mysql_result($query, 0) == 1) ? true : false;
}

/**
 * Returns the username (string) if DB has a match
 * for $username and md5'ed $password. If not 
 * boolean false is returned.
 * @param string $username
 * @param string $password
 * @return Ambiguous <boolean, string>
 * PRECONDITION: Requires database fields 
 * 'username' (CHAR) and 'password' (CHAR).
 */
function login($username, $password) {
	$username = mysql_real_escape_string($username); // sanitize
	$password = md5($password);

	$query = mysql_query("SELECT COUNT(`username`) FROM `Users` WHERE `username` = '$username' AND `password` = '$password';");
	$result = mysql_result($query, 0);
	
	return ($result == 1) ? $username : false;
}

?>
