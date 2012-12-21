	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner"> 
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
          	</a> 
          	<a class="brand" href=".">TinyBiz</a>
          	<div class="nav-collapse collapse">
					<ul class="nav">
		         	<li><a href="about.php">About</a></li>
		           	<li><a href="contact.php">Contact</a></li>
		           	
					<?php 
		         if (!logged_in()) {
		           	?>
						<li><a href="#loginModal" data-toggle="modal">Log In</a></li><!-- log in tab, references myModal-->
				  		<?php
				  	}
				  	else {
				  		?>
				  		<li class="dropdown">
				  			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				  				<span class="label label-info"><?php echo strtolower($user_data['username']); ?></span> <b class="caret"></b>
				  			</a>
				         <ul class="dropdown-menu"><!-- TODO: modify all these links for specific user -->
				         	<li><a href="user-settings.php">General Settings</a></li>
						  		<li><a href="index.html">Delete Account</a></li>
				            <li><a href="logout.php">Log Out</a></li>
				            <li class="divider"></li>
				            <li class="nav-header">Store</li><!-- TODO: get stores with $user_id equal to $user_data['user_id'] -->
				            <li><a href="store.php?bid=<?php echo business_id_from_name($business_data['name']); ?>" class="link"><?php echo $business_data['name']; ?></a></li>
				         </ul>
						</li>
						<?php
						}
					?>				  			
		         </ul> 
		         <?php include 'core/functions/search.php'; ?>
				   	<form class="navbar-form pull-right" method="GET" action="sleek_search.php">				   		
            			<input value="<?php echo $_GET['search_term']; ?>" name="search_term" class="search-query" type="Search" placeholder="Search..." id="searchBox" />
            			
					</form>
				</div><!-- ENDS nav-collapse-->
			</div><!-- ENDS container -->
      </div><!-- ENDS navbar-inner -->
	</div><!-- ENDS navbar -->
