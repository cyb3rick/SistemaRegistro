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

?>