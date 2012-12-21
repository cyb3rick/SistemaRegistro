
<?php

function sale_id_from_sale_title_descripion($title, $description) {
	// join weekly and daily
	return $sale_id;
}

function delete_special($sale_id) {
	$query = mysql_query("DELETE FROM Special_Offers WHERE sale_id='$sale_id';") or die(mysql_error());

	return $query;
}

/**
 * Returns an indexed array of assoc arrays
 * containing the keys in Special_Offers table.
 */
function get_specials($business_id) {
	$query = mysql_query("SELECT * FROM `Special_Offers` WHERE `business_id` = '$business_id';");
	$data = array();
	while ($row = mysql_fetch_assoc($query)) {
		$data[] = $row;
	}
	return $data;
}

/**
 * Inserts a record in Special_Offers table. 
 * Returns true if insert was successful.
 * Otherwise, dies with an error.
 */
function create_special($business_id, $title, $description, $thumbnail_url, $start_date, $end_date, $weekly) {
	$query = mysql_query("INSERT INTO Special_Offers (title, description, thumbnail_url, start_date, end_date, business_id, weekly) VALUES ('$title', '$description', '$thumbnail_url', '$start_date', '$end_date', '$business_id', '$weekly');") or die(mysql_error());

	return true;
}

?>
