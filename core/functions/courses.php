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

function amount_of_courses_per_level($level) {
	
	$query = mysql_query("SELECT COUNT(cid) AS cnt FROM Courses WHERE level='$level';");	
	$result = mysql_fetch_array($query);
	return $result['cnt']; // count
}

// TODO: check validity of $sec_id
function get_course_from_section($sec_id) {
	$query = mysql_query("SELECT c.name as cname, c.description as cdesc 
							FROM Courses c, Sections s 
								WHERE c.cid=s.cid AND s.sec_id='$sec_id';");
	return mysql_fetch_assoc($query);	
}

?>