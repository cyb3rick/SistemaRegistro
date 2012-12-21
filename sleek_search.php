<?php include 'core/init.php' ?>
<?php include 'template/header.php' ?>
<?php include 'template/includes/widgets/login_modal.php' ?> <!-- login modal -->

<div class="row-fluid">
	<div class="span3">
		<div class="well sidebar-nav">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
				<ul class="nav nav-list">
				
					<li class="nav-header">Refine your search</li>	              
	              	<li><small>Choose Category:</small></li>
	              	<li>
	              		<select name="cat">
	              			<option value="">All</option>
							<?php
							$category_list = get_categories();
							foreach ($category_list as $c) {
								echo "<option value=". $c['category_id'] .">". $c['name'] ."</option>";
							}						
							?>						
						</select>
	              	</li>
	              	<li></li>
	              	<li><small>Display Only:</small></li>
	              	<li>
	              		<select name="items">
	              			<option value="">All</option>
	              			<option value="10">10</option>
	              			<option value="20">20</option>
	              			<option value="50">50</option>	              		
	              		</select>
	              	</li>        
              	
				</ul>
				
				<input type="hidden" name="search_term" value="<?php echo $_GET['search_term']; ?>" />
				<center>
					<input type="submit" class="btn" value="Search Again" />
				</center>
			</form>
		</div><!--/.well -->
	</div><!--/span-->
        
	<div class="span9">
		<h1>We found...</h1>
		<hr>
		
		
		<!-- 
		
		TODO:
		
		-check if query is empty
		-if filters are set
			-modify query accordingly
		-display results
		
		 -->
		
		<?php 
		
	if (isset($_GET['search_term'])) {
		$search_term = mysql_real_escape_string($_GET['search_term']); // sanitize input
		
		/* find businesses */				
		$stores_query = "SELECT Businesses.name as bname,
								Businesses.phone as bphone,
								Businesses.street_number as bsn,
								Businesses.city as bcity,
								Businesses.zipcode as bzip,
								Businesses.profile_pic_url as bppu,
								Categories.name as cname,
								Users.first_name as fname,
								Users.last_name as lname
						FROM Businesses, Categories, Users
						WHERE Categories.category_id = Businesses.category_id AND 
							  Businesses.username = Users.username AND (
								Businesses.name LIKE '%$search_term%' ||
								Businesses.city LIKE '%$search_term%' ||
								Businesses.phone LIKE '%$search_term%' ||
								Businesses.zipcode LIKE '%$search_term%' ||
								Businesses.street_number LIKE '%$search_term%'
						)";
		if (isset($_GET['cat']) && !empty($_GET['cat'])) {
			$category_id = $_GET['cat'];
			
			$stores_query = "SELECT Businesses.name as bname,
									Businesses.phone as bphone,
									Businesses.street_number as bsn,
									Businesses.city as bcity,
									Businesses.zipcode as bzip,
									Businesses.profile_pic_url as bppu,
									Categories.name as cname,
									Users.first_name as fname,
									Users.last_name as lname 
							 FROM Businesses, Categories, Users 
							 WHERE Categories.category_id = Businesses.category_id AND
							 	Businesses.username = Users.username AND  
							 	Categories.category_id = $category_id AND (							 	
							 	Businesses.name LIKE '%$search_term%' || 
							 	Businesses.city LIKE '%$search_term%' || 
							 	Businesses.phone LIKE '%$search_term%' || 
							 	Businesses.zipcode LIKE '%$search_term%' || 
							 	Businesses.street_number LIKE '%$search_term%' 							 
							 )";
		}
													  
		if (isset($_GET['items']) && !empty($_GET['items'])) {
			$items = $_GET['items'];		
			$stores_query = "$stores_query LIMIT $items";			
		}
				
		//display stores
		$stores_results = mysql_query($stores_query);
		
		while ($row = mysql_fetch_assoc($stores_results)) {
			?>
			<div class="row-fluid found-item" style="border:1px dashed red;">
				<div class="span2">
					<img style="max-width:150px; max-height:150px;" class="img-rounded" src="<?php echo $row['bppu']; ?>" />
				</div>
				
				<div class="span10 <?php echo "store"; ?>">
					
					<p style="font-size:18px; margin_bottom: 10px; color:#777"><?php echo $row['bname']; ?></p>	
					<p><strong>Owner:</strong> <?php echo $row['fname'] . " " . $row['lname']; ?><br />
					<strong>Category: </strong> <?php echo $row['cname']; ?><br />
					<strong>Address: </strong> <?php echo $row['bsn'] . ", <br />" . $row['bcity'] . ", PR, " . $row['bzip']; ?></p>					

				</div>
				
			</div>
			<?php
			
		}
		
		
		
		
		/* find weekly specials */		
		$specials_query = "SELECT title,
		description,
		thumbnail_url,
		start_date,
		end_date,
		weekly,
		Businesses.name as bname,
		Categories.name as cname 
		FROM Special_Offers, Businesses, Categories 
		WHERE Special_Offers.business_id = Businesses.business_id AND
		end_date >= CURDATE() AND
		Categories.category_id = Businesses.category_id AND (
		title LIKE '%$search_term%' || 
		description LIKE '%$search_term%' ||
		Businesses.name LIKE '%$search_term%')";
			
		if (isset($_GET['cat']) && !empty($_GET['cat'])) {
			$category_id = $_GET['cat'];
				
			$specials_query = "SELECT title,
							description,	
							thumbnail_url,
							start_date,
							end_date,
							weekly,
							Businesses.name as bname,
							Categories.name as cname 
							FROM Special_Offers, Businesses, Categories 
							WHERE Special_Offers.business_id = Businesses.business_id AND 
							end_date >= CURDATE() AND
							Categories.category_id = Businesses.category_id AND
							Categories.category_id = $category_id AND (
							title LIKE '%$search_term%' || 
							description LIKE '%$search_term%' ||
							Businesses.name LIKE '%$search_term%')";

		}
			
		if (isset($_GET['items']) && !empty($_GET['items'])) {
				$items = $_GET['items'];
				$specials_query = "$specials_query LIMIT $items";
		}
				
		//display stores
		$specials_results = mysql_query($specials_query);
		
		while ($row = mysql_fetch_assoc($specials_results)) {
		?>
					<div class="row-fluid found-item" style="border:1px dashed red;">
						<div class="span2">
							<img style="max-width:150px; max-height:150px;" class="img-rounded" src="<?php echo $row['thumbnail_url']; ?>" />
						</div>
						
						<div class="span10 <?php echo (weekly) ? "weekly" : "daily"; ?>">
							
							<p style="font-size:16px; color:#777"><?php echo $row['title']; ?></p>
							<p><strong>Description: </strong> <?php echo $row['description']; ?><br />
							<strong>Available: </strong> <?php echo $row['start_date']; ?> to <?php echo $row['end_date']; ?><br />							
							<strong>Category: </strong> <?php echo $row['cname']; ?><br />
							<strong>Store: </strong> <?php echo $row['bname']; ?></p>
		
						</div>
						
					</div>
					<?php
					
				}
		
		
		
		
	}
		
		?>

				
	</div><!-- ends span9 -->
</div>

<?php include 'template/footer.php' ?>
