<?php include 'core/init.php' ?>
<?php include 'template/header.php' ?>
<?php include 'template/includes/widgets/login_modal.php' ?> <!-- login modal -->


<?php 
	if (!logged_in()) {
	?>
	
	<form class="form-signin" action="login.php" method="post">
		<h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" name="username" class="input-block-level" placeholder="Username">
        <input type="password" name="password" class="input-block-level" placeholder="Password">
        
        <button type="submit" name="submit" class="btn btn-large btn-block btn-primary">Sign in</button>
	</form>
	<?php
	}
	else {
	?>
	<!-- show stats and the coolest search box -->
	<div class="row">
		<div class="span12">
			<h1>Búsqueda Rápida</h1>
			<br />		
			<br />
			<div class="span2"></div>
			<div class="span8">
				<!--<form id="searchform">
					<div>
						What are you looking for? <input type="text" size="30" value="" id="inputString" onkeyup="lookup(this.value);" />
					</div>
					<div id="suggestions"></div>
				</form>-->
			
				 <form>
					<label>Nombre, Apellido, Direccion, Telefono o Celular...</label>
					<input type="text" class="input-block-level" id="inputString" onkeyup="lookup(this.value);" style="font-size:36px;height:50px;" />        
				</form>						
			</div>
			<div class="span2"></div>		
		</div><!-- /.span12 -->		
	</div><!-- /.row -->
	
	<div class="row">
		<div class="span12">
			<div class="span2"></div>
			<div id="suggestions" class="span8">
							
			</div><!-- /#suggestions -->
			<div class="span2"></div>
		</div>
	</div>
	<?php
	}
?>				
	
	
	
	          

<?php include 'template/footer.php' ?>