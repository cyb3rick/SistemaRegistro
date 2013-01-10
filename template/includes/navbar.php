	<div class="navbar navbar-fixed-top" style="opacity:0.9">
		<div class="navbar-inner"> 
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
          	</a> 
          	<a class="brand" href=".">Ministerio de Educaci&#243;n</a>
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
			         	<li><a href="user-settings.php"><i class="icon-cog"> </i> Ajustes</a></li>
			            <li><a href="logout.php"><i class="icon-off"> </i> Salir</a></li>
			            <!-- <li class="divider"></li> -->
			            <!-- <li class="nav-header">Store</li> -->
			            <!-- <li><a href="#" class="link">Something</a></li> -->
			         </ul>
					</li>
					<?php
		         	}
					?>					
		        </ul> 
				</div><!-- ENDS nav-collapse-->
			</div><!-- ENDS container -->
      </div><!-- ENDS navbar-inner -->
	</div><!-- ENDS navbar -->
