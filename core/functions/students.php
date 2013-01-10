<?php

function student_exists($sid) {	
	$sid = mysql_real_escape_string($sid); // sanitize
	$query = mysql_query("SELECT COUNT(`sid`) FROM Students WHERE sid='$sid';") or die(mysql_error());
	$result = mysql_result($query,0);
	return (mysql_result($query, 0) == 1) ? true : false;
}

/**
 * Called like this: student_data($sid, 'first_name', 'last_name', ...);
 * @param unknown_type $sid
 * @return associative array with student data
 */
function student_data($sid) {	
	
	$data = array();
			
	$func_num_args = func_num_args(); // returns number of args passed to user_data()
	$func_get_args = func_get_args(); // array with args
		
	if ($func_num_args > 1) {
		unset($func_get_args[0]); // remove first element from $func_get_args ($user_id)
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		
		$query = mysql_query("SELECT $fields FROM Students WHERE sid='$sid';");
		$data = mysql_fetch_array($query);

		return $data;
	}
	
}


/**
 * Checks whether the student passed
 * a given course.
 */
function student_passed_course($sid, $cid) {
	$query = "SELECT COUNT(sid)
	FROM HasTaken, Sections
	WHERE Sections.sec_id = HasTaken.sec_id AND cid='$cid' AND passed='1';";

	$result = mysql_result($query,0);
	return (mysql_result($query, 0) == 1) ? true : false;

}


function get_approved_courses($sid) {

	$query = mysql_query("SELECT c.name as cname, sem_code, year, rid 
							FROM HasTaken ht, Sections s, Courses c 
								WHERE ht.sec_id=s.sec_id 
									AND sid='$sid' 
										AND c.cid = s.cid 
											AND passed='1';");

	$approved_list = array();
	while ($row = mysql_fetch_assoc($query)) {
		$approved_list[] = $row;
	}

	return $approved_list;
}

function amount_approved_courses_per_level($sid, $level) {

	$query = mysql_query("SELECT COUNT(c.name) as cnt
			FROM HasTaken ht, Sections s, Courses c
			WHERE ht.sec_id=s.sec_id
			AND sid='$sid' 
			AND c.cid = s.cid 
			AND c.level = '$level' 
			AND passed='1';");

		
	$result = mysql_fetch_array($query);
	return $result['cnt']; // count
}

function get_failed_courses($sid) {
	$curr_year = get_current_year();
	$curr_semester = get_current_semester();
	
	$query = mysql_query("SELECT c.name as cname, sem_code, year, rid
			FROM HasTaken ht, Sections s, Courses c
			WHERE ht.sec_id=s.sec_id
			AND sid='$sid'
			AND c.cid = s.cid
			AND passed='0'
			AND (year != '$curr_year' OR sem_code != '$curr_semester');");
	
		

			$failed_list = array();
			while ($row = mysql_fetch_assoc($query)) {
			$failed_list[] = $row;
	}

	return $failed_list;
}

function get_in_progress_courses($sid) {
	$curr_year = get_current_year();
	$curr_semester = get_current_semester();
	
	$query = mysql_query("SELECT c.name as cname, sem_code, year, rid  
							FROM HasTaken ht, Sections s, Courses c 
								WHERE s.sec_id = ht.sec_id 
									AND sid='$sid' 
										AND year='$curr_year'
											AND sem_code='$curr_semester'
												AND s.cid = c.cid;");

	$in_progress_list = array();
	while ($row = mysql_fetch_assoc($query)) {
		$in_progress_list[] = $row;
	}

	return $in_progress_list;
}

function last_approved_course($sid) {
	$query = mysql_query("SELECT c.name as cname, sem_code, year, rid
			FROM HasTaken ht, Sections s, Courses c
			WHERE ht.sec_id=s.sec_id
			AND sid='$sid'
			AND c.cid = s.cid
			AND passed='1'
			ORDER BY year DESC, sem_code DESC
			LIMIT 1;");
	
	$last = mysql_fetch_assoc($query);
	return $last; // return record with info about last approved course.	
}

function get_student_fullname($sid) {
	$query = mysql_query("SELECT first_name, middle_name, last_name FROM Students WHERE sid='$sid';");
	$row = mysql_fetch_assoc($query);
	if ( empty($row['middle_name']) ) {
		return $row['first_name'] . ' ' . $row['last_name'];
	}
	else {
		return $row['first_name'] . ' ' . $row['middle_name'] . ' ' .$row['last_name'];
	}
}

function get_all_students() {
	$query = mysql_query("SELECT * FROM Students;");
	
	$students_list = array();
	while ($row = mysql_fetch_assoc($query)) {
		$students_list[] = $row;
	}
	
	return $students_list;
}

?>
