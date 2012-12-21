	<!-- STARTS login modal -->
	<div class="modal hide fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
		
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3 id="loginModalLabel">My Account</h3>
		</div><!-- ENDS modal header -->
			
		<div class="modal-body">					
				<form action="login.php" method="post">
					<label>Username</label>
					<input type="text" class="input-xlarge" placeholder="Username" name="username" />
					<label>Password</label>
					<input type="password" class="input-xlarge" placeholder="Password" name="password" />
					<hr>
					<input type="submit" name="submit" class="btn btn-large btn-primary" value="Log in" />					
					<a href="register.php" class="btn btn-large btn-success pull-right">Register</a>
				</form>
		</div><!-- ENDS modal body -->
	</div><!-- ENDS modal -->
