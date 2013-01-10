<?php
function get_teachers() {
	
	$query = mysql_query("SELECT * FROM Teachers;");
	
	$teachers_list = array();
	while ($row = mysql_fetch_assoc($query)) {
		$teachers_list[] = $row;
	}
	
	return $teachers_list;
	
}

function get_teacher_fullname($tid) {
	$query = mysql_query("SELECT first_name, last_name FROM Teachers WHERE tid='$tid';");
	$row = mysql_fetch_assoc($query);
	return $row['first_name'] . ' ' . $row['last_name'];	
}


function get_teacher_sections($tid) {

	$query = mysql_query("SELECT sec_id, c.name as cname, d.name as dname, rid, sem_code, year from Sections s, Courses c, Days d where tid='$tid' AND s.cid = c.cid AND s.did = d.did ORDER BY year DESC, sem_code DESC;");

	$sections_list = array();
	while ($row = mysql_fetch_assoc($query)) {
		$sections_list[] = $row;
	}

	return $sections_list;

}

/**
 * Boolean function that tests whether a
 * teacher already has a section assigned
 * for a given day.
 * @param unknown_type $tid
 * @param unknown_type $did
 * @return boolean
 */
function teacher_is_busy($tid, $did) {
	$query = mysql_query("SELECT COUNT(sec_id) FROM Sections WHERE tid='$tid' AND did='$did';") or die(mysql_error());
	$result = mysql_fetch_array($query);
	return ($result[0] == 1) ? true : false;
}

function teacher_exists($tid) {
	$tid = mysql_real_escape_string($tid); // sanitize
	$query = mysql_query("SELECT COUNT(`tid`) FROM Teachers WHERE tid='$tid';") or die(mysql_error());
	$result = mysql_result($query,0);
	return (mysql_result($query, 0) == 1) ? true : false;
}


/**
 * Called like this: teacher_data($tid, 'first_name', 'last_name', ...);
 * @param unknown_type $sid
 * @return associative array with teacher data
 */
function teacher_data($tid) {

	$data = array();
		
	$func_num_args = func_num_args(); // returns number of args passed to user_data()
	$func_get_args = func_get_args(); // array with args

	if ($func_num_args > 1) {
		unset($func_get_args[0]); // remove first element from $func_get_args ($user_id)
		$fields = '`' . implode('`, `', $func_get_args) . '`';

		$query = mysql_query("SELECT $fields FROM Teachers WHERE tid='$tid';");
		$data = mysql_fetch_array($query);

		return $data;
	}

}
?>