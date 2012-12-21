	<!-- STARTS login modal -->
	<div class="modal hide fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
		
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>			
		</div><!-- ENDS modal header -->
			
		<div class="modal-body">	
			<form class="form-signin" action="login.php" method="post">
				<h2 class="form-signin-heading">Please sign in</h2>		
		        <input type="text" name="username" class="input-block-level" placeholder="Username">
		        <br />
		       	<input type="password" name="password" class="input-block-level" placeholder="Password">
		        <br />	        
		        <button type="submit" name="submit" class="btn btn-large btn-block btn-primary">Sign in</button>
	        </form>				
		</div><!-- ENDS modal body -->
	</div><!-- ENDS modal -->
