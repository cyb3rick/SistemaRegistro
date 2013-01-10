<?php include 'core/init.php' ?>
<?php include 'template/header.php' ?>
<?php include 'template/includes/widgets/login_modal.php' ?> <!-- login modal -->

<?php 
	/* If not logged in, show login box instead. */
	if (!logged_in()) { include 'template/includes/widgets/login_box.php'; }
	else if ( !isset($_GET['tid']) OR !teacher_exists($_GET['tid']) ) { // tid is not valid.
	?>
	<!-- Display invalid teacher id error. -->
	<div class="row">
		<div class="span12">
			<h1>Teacher</h1>
			<br />		
			<br />
			<div class="span2"></div>
			<div class="span8">
				<div class='alert'>
					Error: El tid provisto es invalido o no provey&#243; ninguno.<button type='button' class='close' data-dismiss='alert'> <i class="icon-remove"></i> </button>
				</div>
				<a href='.' class='btn btn-large'><i class="icon-chevron-left icon-white"></i> Inicio</a>
			</div>
			<div class="span2"></div>
		</div><!-- /.span12 -->
	</div><!-- /.row -->	
	<?php 
	}
	else { // sid is valid -> do cool stuff.
		
		// Store and sanitize passed in tid.
		$tid = mysql_real_escape_string($_GET['tid']);
	
		// Get all data from teacher.
		$teacher_data = teacher_data($tid, 'first_name', 'middle_name', 'last_name', 'phone', 'cellphone', 'email'); // TODO: get picture url
		
	?>
	<!-- Show the coolest search box. -->
	<div class="row">
		<div class="span2"></div>
		<div class="span8">
			<h1>
				<?php
					// Display fullname: check first if student has middle name. 
					echo $teacher_data['first_name'];
					echo ( empty($teacher_data['middle_name']) ? " " : " " . $teacher_data['middle_name'] . " ");
					echo $teacher_data['last_name'];
				?>				
			</h1>
			<h4><span class="badge badge-success">Maestro</span></h4><!-- Sub-category -->
		</div>
		<div class="span2"></div>
	
	</div>
	
	<div class="row">
		<div class="span2"></div>
		<div class="span8">
			<div class="row">					
				<div class="span8">										
					<div class="row">
						<div class="span4"><!-- First column -->								
							<form><!-- TODO: Create the action script that saves teacher's information. -->								
								<div class="control-group">
						   			<label class="control-label">Nombre</label>
						    		<div class="controls">
						    			<input class="input-xlarge" type="text" name="first_name" value="<?php echo $teacher_data['first_name']; ?>">
						    		</div>
						    	</div>
						    	
						    	<div class="control-group">
						   			<label class="control-label">Segundo Nombre</label>
						    		<div class="controls">
						    			<input class="input-xlarge" type="text" name="last_name" value="<?php echo $teacher_data['middle_name']; ?>">
						    		</div>
						    	</div>
						    	
						    	<div class="control-group">
						   			<label class="control-label">Apellido</label>
						    		<div class="controls">
						    			<input class="input-xlarge" type="text" name="middle_name" value="<?php echo $teacher_data['last_name']; ?>">
						    		</div>
						    	</div>
						    	
						    	<div class="control-group">
						   			<label class="control-label">Tel&#233;fono Residencial</label>
						    		<div class="controls">
						    			<input class="input-xlarge" type="text" name="phone" value="<?php echo $teacher_data['phone']; ?>">
						    		</div>
						    	</div>
						    	
						    	<div class="control-group">
						   			<label class="control-label">Celular</label>
						    		<div class="controls">
						    			<input class="input-xlarge" type="text" name="cellphone" value="<?php echo $teacher_data['cellphone']; ?>">
						    		</div>
						    	</div>
						    	
						    	<div class="control-group">
						   			<label class="control-label">Correo Eletr&#243;nico</label>
						    		<div class="controls">
						    			<input class="input-xlarge" type="text" name="email" value="<?php echo $teacher_data['email']; ?>">
						    		</div>
						    	</div>
						    								    	
						   		<div class="control-group">
						   			<label>&nbsp;</label>
						    		<div class="controls">							    		
						    			<button type="submit" class="btn"><strong>Guardar Cambios</strong> <i class="icon-hdd icon-white"></i></button>
						   			</div>
						    	</div>
						    </form><!-- /form -->								    					
						</div><!-- /.span4 -->
						
						<div class="span4"><!-- Second column -->
							<div class="row">
								<label>Display important info here:</label>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tempus suscipit eros sed condimentum. Nulla molestie dignissim elementum. Nulla nulla magna, mollis sit amet rutrum sit amet, laoreet lobortis sapien. Fusce laoreet, enim non blandit faucibus, urna quam malesuada nulla, posuere ullamcorper dolor ipsum at nisl. Nulla facilisi. Praesent in orci sem, sit amet luctus tellus. Proin facilisis pretium neque, eget pretium ante blandit et. Nunc nec purus sem. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sit amet mi rutrum augue tincidunt tristique. Pellentesque sit amet quam ante. Pellentesque tempus ornare ipsum, quis aliquam elit vehicula vel. Proin eget erat vel libero feugiat suscipit in varius tellus. Integer vel felis sit amet mi facilisis tempus. Phasellus bibendum quam non ligula fringilla ac sagittis tortor vestibulum. Vestibulum et ante sit amet elit dictum sagittis.</p>									
							</div><!-- /.row -->
							
																					
						</div><!-- /.span4 (ends second column) -->
					</div><!-- /.row -->					
				</div><!-- /first section -->
			</div>				
			<div class="row">
				<div class="span8">
					<h2 id="tabs">Secciones</h2>
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
						        <th>Clase</th>
						        <th>A&#241;o</th>
						        <th>Semestre</th>
						        <th>Dia</th>
						        <th>Sal&#243;n</th>
						        <th>Acci&#243;n</th>
							</tr>
						</thead>
						<tbody>
							<!-- insert body here -->
							<?php 
							// sec_id | cid | tid | rid | did | sem_code | year | cid | name | level | description
							$sections_list = get_teacher_sections($tid);
						
							foreach ($sections_list as $s) {
								echo "<tr>";
								echo "<td>".$s['cname']."</td>";
								echo "<td>".$s['year']."</td>";
								echo "<td>".$s['sem_code']."</td>";
								echo "<td>".$s['dname']."</td>";
								echo "<td>".$s['rid']."</td>";
								echo "<td><a class='btn btn-mini btn-primary' href=section.php?sec_id=".$s['sec_id'].">Ver estudiantes</a></td>";									
								echo "</tr>";
							}											
							?>
						</tbody>
					</table><!-- /table -->
				</div><!-- /.span8 -->		
			</div>				
		</div>
		<div class="span2"></div>		
				
	</div><!-- /.row -->
	<?php
	}
?>		

<?php include 'template/footer.php' ?>