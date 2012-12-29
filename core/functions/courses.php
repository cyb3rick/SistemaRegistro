<?php
function get_courses() {

	$query = mysql_query("SELECT * FROM Courses;");

	$category_list = array();
	while ($row = mysql_fetch_assoc($query)) {
		$category_list[] = $row;
	}

	return $category_list;
}


function get_rooms() {

	$query = mysql_query("SELECT * FROM Rooms;");

	$rooms_list = array();
	while ($row = mysql_fetch_assoc($query)) {
		$rooms_list[] = $row;
	}

	return $rooms_list;
}

function get_days() {

	$query = mysql_query("SELECT * FROM Days ORDER BY did;");

	$days_list = array();
	while ($row = mysql_fetch_assoc($query)) {
		$days_list[] = $row;
	}

	return $days_list;
}

function get_current_semester() {	
	$current_month = date('m', time());	
	
	// IMPORTANT: We return 1 or 2 because those are the 
	// id's assumed for semesters. If the Semesters table
	// were to change we'd have to do an update of these
	// id's to represent the right semester. TODO: query 
	// this id's directly from the database.
	return ($current_month < 8) ? 1 : 2;	
}

function get_current_year() {	
	return date('Y', time());
}




?>