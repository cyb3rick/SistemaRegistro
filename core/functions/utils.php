<?php
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