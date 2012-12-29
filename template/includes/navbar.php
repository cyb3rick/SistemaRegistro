	<div class="navbar navbar-fixed-top" style="opacity:0.9">
		<div class="navbar-inner"> 
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
          	</a> 
          	<a class="brand" href=".">Ministerio de Educación</a>
          	<div class="nav-collapse collapse">
				<ul class="nav">
					<li><a href="reports.php">Reportes</a></li>
					<li><a href="search.php">Buscar</a></li>
					<li><a href="courses.php">Clases</a></li>
					<!-- 
		         	<li><a href="about.php">About</a></li>
		           	<li><a href="contact.php">Contact</a></li>
		           	-->
					<?php 
		         	if (logged_in()) {
		           		?>
				  		<li class="dropdown">
				  			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				  				<span class=""><?php echo strtolower($user_data['username']); ?></span> <b class="caret"></b>
				  			</a>
				         <ul class="dropdown-menu"><!-- TODO: modify all these links for specific user -->
				         	<li><a href="user-settings.php"><i class="icon-cog"> </i> Settings</a></li>
				            <li><a href="logout.php"><i class="icon-off"> </i> Log Out</a></li>
				            <li class="divider"></li>
				            <li class="nav-header">Store</li><!-- TODO: get stores with $user_id equal to $user_data['user_id'] -->
				            <li><a href="#" class="link">Something</a></li>
				         </ul>
						</li>
						<?php
					}
					?>				  			
		        </ul> 
		         <?php include 'core/functions/search.php'; ?>
		         <!-- 
				   	<form class="navbar-form pull-right" method="GET" action="sleek_search.php">				   		
            			<input value="<?php echo $_GET['search_term']; ?>" name="search_term" class="search-query" type="Search" placeholder="Search..." id="searchBox" />
            			
					</form>
					-->
				</div><!-- ENDS nav-collapse-->
			</div><!-- ENDS container -->
      </div><!-- ENDS navbar-inner -->
	</div><!-- ENDS navbar -->
