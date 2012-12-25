<?php include 'core/init.php' ?>
<?php include 'template/header.php' ?>
<?php include 'template/includes/widgets/login_modal.php' ?> <!-- login modal -->

	<div class="row"><!-- Page title -->
		<div class="span12">
			<h1>Configuración</h1>
			<br />
			<br />
		</div>
	</div>
			
	<div class="row">
		<div class="span2"></div>
      	
      	<div class="span8">
		<?php 
			if ( isset($_GET['u']) ) {
			   	$u = $_GET['u'];
			   	if ($u == "name") {
			   		echo "<div class='alert alert-success'>Done. Your first and last name has been updated.";
			   	}
			   	else if ($u == "epass") {
			   		echo "<div class='alert'>Error: Some passwords fields were empty.";
			   	}
			   	else if ($u == "opass") {
			   		echo "<div class='alert'>Error: That is not your current password.";
			   	}
			   	else if ($u == "cpass") {
			   		echo "<div class='alert'>Error: Wrong password confirmation.";
			   	}
			   	else if ($u == "pass") {
			   		echo "<div class='alert alert-success'>Done. Your password was successfully updated.";
			   	}
				echo " <button type='button' class='close' data-dismiss='alert'> × </button></div>";
			}		      
	  	?>
		</div><!-- /.span8 -->
		
		<div class="span2"></div>
			  		
	</div>
	
	<div class="row">
		<div class="span2"></div>
      	
      	<div class="span8">
			<!-- Accordion used to create a menu with hidden elements -->
      		<div class="accordion" id="accordionUserSettings" style="background:#fff;">
				<div class="accordion-group hide">
					<div class="accordion-heading" style="margin-left:10px;margin-top:10px;"></div>
					<div id="collapseOne" class="accordion-body collapse in"></div>
				</div>
					
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionUserSettings" href="#collapseName">Name</a>
					</div>
					<!-- First element of accordion -->
					<div id="collapseName" class="accordion-body collapse">
						<!-- Elements inside of name element of accordion -->
						<div class="accordion-inner">								
							<form action="user-settings-fullname.php" method="post"><!-- TODO: define the action here -->
								<label>First Name</label>
								<input type="text" name="first_name" value="<?php echo $user_data['first_name']; ?>" />
								<label>Last Name</label>
								<input type="text" name="last_name" placeholder="Last Name" value="<?php echo $user_data['last_name']; ?>" />	
								<br />
								<br />
								<input type="submit" name="submit_fullname" value="Save Changes" />
							</form>
						</div>
					</div>
				</div><!-- ends name group -->
					
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionUserSettings" href="#collapsePassword">Password</a>
					</div>
					<div id="collapsePassword" class="accordion-body collapse">
						<div class="accordion-inner">
							<form action="user-settings-password-edit.php" method="post">
								<label>Old Password</label>
								<input type="password" name="old_pass" />
								<label>New Password</label>
								<input type="password" name="new_pass" />
								<label>Confirm Password</label>
								<input type="password" name="new_pass_conf" />
								<br />
								<br />
								<input type="submit" name="submit_password" value="Save Settings" />	
							</form>							
						</div>
					</div>
				</div><!-- ends pwd group -->
					
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionUserSettings" href="#collapseEmail">Email</a>
					</div>
					<div id="collapseEmail" class="accordion-body collapse">
						<div class="accordion-inner">
							<form action="user-settings-email-edit.php" method="post">
								<label>Email</label>
								<input type="text" name="email" value="<?php echo $user_data['email']; ?>">
								<br />
								<br />
								<input type="submit" name="submit_email" value="Save Settings" />	
							</form>							
						</div>
					</div>
				</div><!-- ends email group -->		
			</div><!-- ends accordion -->		
		</div><!-- end of span8 -->
		      	
		<div class="span2"></div>  
	</div><!-- end row -->      

<?php include 'template/footer.php' ?>
