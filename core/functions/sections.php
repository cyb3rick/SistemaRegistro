<?php

function section_exists($sec_id) {
	$sec_id = mysql_real_escape_string($sec_id); // sanitize
	$query = mysql_query("SELECT COUNT(sec_id) FROM Sections WHERE sec_id='$sec_id';") or die(mysql_error());
	$result = mysql_result($query,0);
	return (mysql_result($query, 0) == 1) ? true : false;
}

function get_current_sections($cid) {
	
	$query = mysql_query("SELECT sec_id, T.tid, C.name, rid, D.name as Day, sem_code, year, T.first_name, T.last_name 
							FROM Sections S, Days D, Courses C, Teachers T 
								WHERE S.tid=T.tid AND S.did=D.did AND S.cid=C.cid AND sem_code='".get_current_semester()."' AND year='".get_current_year()."' AND C.cid='$cid';");
	
	$sections_list = array();
	while ($row = mysql_fetch_assoc($query)) {
		$sections_list[] = $row;
	}

	return $sections_list;

}

/**
 * Boolean function that tests whether a
 * room already has a section assigned
 * for a given day.
 * @param unknown_type $rid
 * @param unknown_type $did
 * @return boolean
 */
function room_is_occupied($rid, $did) {
	$query = mysql_query("SELECT COUNT(sec_id) FROM Sections WHERE rid='$rid' AND did='$did';") or die(mysql_error());
	$result = mysql_fetch_array($query);
	return ($result[0] == 1) ? true : false;
}

function add_section($cid, $tid, $rid, $did, $sem_code, $year) {
	// Sections: sec_id | cid | tid | rid | did | sem_code | year	
	$query = mysql_query("INSERT INTO Sections (cid,tid,rid,did,sem_code,year) 
			VALUES ('$cid','$tid','$rid','$did','$sem_code','$year');") or die(mysql_error());	
	return true;
}

// TODO: verify no student has this section
function delete_section($sec_id) {
	$query = mysql_query("DELETE FROM Sections WHERE sec_id='$sec_id';") or die(mysql_error());
	return true;
}

/**
 * Called like this: section_data($sec_id, 'year', 'sem_code', ...);
 * @param unknown_type $sec_id
 * @return associative array with section data
 */
function section_data($sec_id) {

	$data = array();
		
	$func_num_args = func_num_args(); // returns number of args passed to user_data()
	$func_get_args = func_get_args(); // array with args

	if ($func_num_args > 1) {
		unset($func_get_args[0]); // remove first element from $func_get_args ($sec_id)
		$fields = '`' . implode('`, `', $func_get_args) . '`';

		$query = mysql_query("SELECT $fields FROM Sections WHERE sec_id='$sec_id';");
		$data = mysql_fetch_array($query);

		return $data;
	}
}

function get_students_from_section($sec_id) {
	$query = mysql_query("SELECT s.sid as sid, first_name, last_name, middle_name, phone, cellphone, email                  | registered_since | converted 
							FROM Students s, HasTaken ht
								WHERE s.sid=ht.sid AND ht.sec_id='$sec_id';");
	
	$students_list = array();
	while ($row = mysql_fetch_assoc($query)) {
		$students_list[] = $row;
	}
	return $students_list;
}

?>