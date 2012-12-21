<?php

/**
 * Returns assoc array of business fields/data
 * given the business id.
 * @param unknown_type $business_id
 */
function business_data_from_business_id($business_id) {
	$query = mysql_query("SELECT * FROM Businesses WHERE business_id = '$business_id';");
	$data = mysql_fetch_assoc($query);

	return $data;
}



/* w */

function owner_name_from_username($username) {

	$data = array();

	$query = mysql_query("SELECT * FROM Users WHERE username LIKE '$username' ");
	$data = mysql_fetch_array($query);

	return $data['first_name'] . ' ' . $data['last_name'];
}

function business_name_from_id($id){

	$data = array();

	$query = mysql_query("SELECT * FROM Businesses WHERE business_id = '$id' ");
	$data = mysql_fetch_array($query);

	return $data['name'];
}

function business_address_from_id($id){

	$data = array();

	$query = mysql_query("SELECT * FROM Businesses WHERE business_id = '$id' ");
	$data = mysql_fetch_array($query);

	return $data['city'] .' , '. $data['street_number'];
}

function likes_dislikes($bid){

	$likes = $_POST['Likes'];
	$dislikes = $_POST['Dislikes'];

	if($likes) {
		mysql_query("UPDATE Businesses SET likes = likes+1 WHERE business_id = '$bid';");
	}
	else if($dislikes) {
		mysql_query("UPDATE Businesses Set dislikes = Dislikes+1 WHERE business_id = '$bid';");
	}

	$getquery = mysql_query("SELECT likes, dislikes FROM Businesses WHERE business_id = '$bid';");

	$row = mysql_fetch_assoc($getquery);
    	
   $likes = $row['likes'];
  	$dislikes = $row['dislikes'];
  	echo "Likes: <span style='font-size:11px;font-weight:bold;color:#009966;'>" . $likes . "</span> | ";
   echo "Dislikes: <span style='font-size:11px;font-weight:bold;color:#990000;'>" . $dislikes . "</span>";
	
}	


function get_comments($bid) {
	$body = $_POST['body'];

	if (isset($_POST['submit_comment'])) {
		if ($body) {
			mysql_query("INSERT INTO Comments (date_posted, body, business_id) VALUES (CURDATE(), '$body', '$bid');");
		}
		else {
			echo "Please fill out all fields";
		}
	}

	$getquery=mysql_query("SELECT * FROM Comments WHERE business_id='$bid' ORDER BY comment_id DESC;");
	
	$data = array(); /* holds arrays with comments */
	
	while($rows=mysql_fetch_assoc($getquery)) {
		$data[] = $rows;
	}				
	return $data;
}

/* end w */


function business_has_specials($business_id) {	
	$query = mysql_query("SELECT COUNT(`sale_id`) FROM `Special_Offers` WHERE `business_id`='$business_id';") or die(mysql_error());
	
	$result = mysql_fetch_array($query);
	//echo $result[0]; die();
	return ($result[0] > 0) ? true : false;
}

function update_business_profile_pic($business_id, $profile_pic_url) {
	$profile_pic_url = mysql_real_escape_string($profile_pic_url); // sanitize
	//echo "UPDATE Businesses SET `profile_pic_url`='$profile_pic_url' WHERE `business_id`='$business_id';"; die();
	$query = mysql_query("UPDATE Businesses SET `profile_pic_url`='$profile_pic_url' WHERE `business_id`='$business_id';") or die("Sorry. Something went wrong while updating the database.");

	/* This point is not reached if something wrong
		happens while updating the database */
	return true;
}

function update_business_address($business_id, $street_number, $city, $zipcode) {
	$street_number = mysql_real_escape_string($street_number); // sanitize 
	$city = mysql_real_escape_string($city);
	$zipcode = mysql_real_escape_string($zipcode);
	
	$query = mysql_query("UPDATE Businesses SET `street_number`='$street_number', `city`='$city', `zipcode`='$zipcode' WHERE `business_id`='$business_id';") or die("Sorry. Something went wrong while updating the database.");

	/* This point is not reached if something wrong
		happens while updating the database */
	return true;
}

function update_business_phone($business_id, $phone) {
	$phone = mysql_real_escape_string($phone); // sanitize TODO: still need to use regex for right format and throw errors
	
	$query = mysql_query("UPDATE Businesses SET `phone`='$phone' WHERE `business_id`='$business_id';") or die("Sorry. Something went wrong while updating the database.");

	/* This point is not reached if something wrong
		happens while updating the database */
	return true;
}

function update_business_category($business_id, $category_id) {
	$phone = mysql_real_escape_string($category_id); // sanitize TODO: still need to use regex for right format and throw errors

	$query = mysql_query("UPDATE Businesses SET `category_id`='$category_id' WHERE `business_id`='$business_id';") or die("Sorry. Something went wrong while updating the database.");

	/* This point is not reached if something wrong
		happens while updating the database */
	return true;
}

function update_business_shopper_url($business_id, $shopper_url) {
	$shopper_url = mysql_real_escape_string($shopper_url); //sanitize
	$query = mysql_query("UPDATE Businesses SET `shopper_url`='$shopper_url' WHERE `business_id`='$business_id';") or die("Sorry. Something went wrong while updating the database.");
		
	/* This point is not reached if something wrong
		happens while updating the database */
	return true;
}

function business_data($business_id) {
	$data = array();
	$business_id = (int) $business_id; // sanitize
	
	$func_num_args = func_num_args(); // returns number of args passed to user_data()
	$func_get_args = func_get_args(); // array with args
	
	if ($func_num_args > 1) {
		unset($func_get_args[0]); // remove first element from $func_get_args ($user_id)
		$fields = '`' . implode('`, `', $func_get_args) . '`';
					
		$query = mysql_query("SELECT $fields FROM `Businesses` WHERE `business_id` = '$business_id';");
		$data = mysql_fetch_array($query);
				
		return $data;
	}
}

function business_id_from_username($username) {
	$username = mysql_real_escape_string($username); // sanitize
	$query = mysql_query("SELECT * FROM Businesses WHERE username = '$username';");
	$row = mysql_fetch_array($query);

	return (int) $row['business_id'];
}

/* uses business name to get id */
function business_id_from_name($name) {
	$name = mysql_real_escape_string($name); // sanitize
	$query = mysql_query("SELECT business_id FROM Businesses WHERE name = '$name';");
	$row = mysql_fetch_array($query);

	return (int) $row['business_id'];
}

function create_business($name, $phone, $street_number, $city, $zipcode, $openning_time, $closing_time, $username, $category_id) {
	//sanitize input
	$name = mysql_real_escape_string($name);
	$phone = mysql_real_escape_string($phone);
	$street_number = mysql_real_escape_string($street_number);
	$city = mysql_real_escape_string($city);
	$zipcode = mysql_real_escape_string($zipcode);
	$openning_time = mysql_real_escape_string($openning_time);
	$closing_time = mysql_real_escape_string($closing_time);
	$category_id = mysql_real_escape_string($category_id);
	
	$query = mysql_query("INSERT INTO Businesses (name, phone, street_number, city, zipcode, openning_time, closing_time, username, category_id) VALUES ('$name', '$phone', '$street_number', '$city', '$zipcode', '$openning_time', '$closing_time', '$username', $category_id);") or die(mysql_error());
	
	//die("Sorry, something went wrong while trying to add business.");
	
	return true;
}




?>
