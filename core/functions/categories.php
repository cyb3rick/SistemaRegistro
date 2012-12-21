<?php

	function get_categories() {
	
		$query = mysql_query("SELECT * FROM `Categories`;");
		
		$category_list = array();
		while ($row = mysql_fetch_assoc($query)) {
			$category_list[] = $row;
		}	
		
		return $category_list;
	}
	
	function category_name_from_category_id($category_id) {
		$query = mysql_query("SELECT * FROM Categories WHERE category_id = '$category_id';");
		$row = mysql_fetch_assoc($query);
		return $row['name'];		
	}

		function category_name_from_id($id){
		$query = mysql_query("SELECT name FROM Categories WHERE category_id = '$id' ");

		$category = array();
		$category =  mysql_fetch_array($query);

		return $category['name'];
	}

?>
