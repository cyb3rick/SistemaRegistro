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



?>
