<?php include 'core/init.php' ?>
<?php include 'template/header.php' ?>
<?php include 'template/includes/widgets/login_modal.php' ?> <!-- login modal -->

<?php 
	/* If not logged in, show login box instead. */
	if (!logged_in()) { include 'template/includes/widgets/login_box.php'; }
	else if ( !isset($_GET['sid']) OR !student_exists($_GET['sid']) ) { // sid is not valid.
	?>
	<!-- Display invalid student id error. -->
	<div class="row">
		<div class="span12">
			<h1>Estudiante</h1>
			<br />		
			<br />
			<div class="span2"></div>
			<div class="span8">
				<div class='alert'>
					Error: El sid provisto es invalido o no provey&#243; ninguno.<button type='button' class='close' data-dismiss='alert'> <i class="icon-remove"></i> </button>
				</div>
				<a href='.' class='btn btn-large'><i class="icon-chevron-left icon-white"></i> Inicio</a>
			</div>
			<div class="span2"></div>
		</div><!-- /.span12 -->
	</div><!-- /.row -->	
	<?php 
	}
	else { // sid is valid -> do cool stuff.
		
		// Store and sanitize passed in sid.
		$sid = mysql_real_escape_string($_GET['sid']);
	
		// Get all data from student.
		$student_data = student_data($sid, 'first_name', 'middle_name', 'last_name', 'phone', 'cellphone', 'email');
		
	?>
	<!-- Show the coolest search box. -->
	
	<div class="row">
		<div class="span2"></div>
		<div class="span8">
			<h1>
				<?php
					// Display fullname: check first if student has middle name. 
					echo $student_data['first_name'];
					echo ( empty($student_data['middle_name']) ? " " : " " . $student_data['middle_name'] . " ");
					echo $student_data['last_name'];
				?>				
			</h1>
			<h4><span class="badge badge-info">Estudiante</span></h4><!-- Sub-category -->
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
							<form><!-- TODO: Create the action script that saves students information. -->								
								<div class="control-group">
						   			<label class="control-label">Nombre</label>
						    		<div class="controls">
						    			<input class="input-xlarge" type="text" name="first_name" value="<?php echo $student_data['first_name']; ?>">
						    		</div>
						    	</div>
						    	
						    	<div class="control-group">
						   			<label class="control-label">Segundo Nombre</label>
						    		<div class="controls">
						    			<input class="input-xlarge" type="text" name="last_name" value="<?php echo $student_data['middle_name']; ?>">
						    		</div>
						    	</div>
						    	
						    	<div class="control-group">
						   			<label class="control-label">Apellido</label>
						    		<div class="controls">
						    			<input class="input-xlarge" type="text" name="middle_name" value="<?php echo $student_data['last_name']; ?>">
						    		</div>
						    	</div>
						    	
						    	<div class="control-group">
						   			<label class="control-label">Tel&#233;fono Residencial</label>
						    		<div class="controls">
						    			<input class="input-xlarge" type="text" name="phone" value="<?php echo $student_data['phone']; ?>">
						    		</div>
						    	</div>
						    	
						    	<div class="control-group">
						   			<label class="control-label">Celular</label>
						    		<div class="controls">
						    			<input class="input-xlarge" type="text" name="cellphone" value="<?php echo $student_data['cellphone']; ?>">
						    		</div>
						    	</div>
						    	
						    	<div class="control-group">
						   			<label class="control-label">Correo Eletr&#243;nico</label>
						    		<div class="controls">
						    			<input class="input-xlarge" type="text" name="email" value="<?php echo $student_data['email']; ?>">
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
								<label>Logros Acad&#233;micos:</label>
								<br />
								<?php 
								// check if approved level 1
								$amount_level_one = amount_of_courses_per_level(1);
								$amount_approved_level_one = amount_approved_courses_per_level($sid, 1);
								
								if ($amount_level_one == $amount_approved_level_one) {
									echo "<div class=span2><img style='max-width:150px;' src='assets/img/level1-badge.png'></div>";
								}
								else {
									echo "<div class=span2><img style='max-width:150px;opacity:0.1' src='assets/img/level1-badge.png'></div>";
								}
								
								// check if approved level 2
								$amount_level_two = amount_of_courses_per_level(2);
								$amount_approved_level_two = amount_approved_courses_per_level($sid, 2);
								
								if ($amount_level_two == $amount_approved_level_two) {
									echo "<div class=span2><img style='max-width:150px;' src='assets/img/level2-badge.png'></div>";
								}
								else {
									echo "<div class=span2><img style='max-width:150px;opacity:0.1' src='assets/img/level2-badge.png'></div>";
								}									
								?>
							</div><!-- /.row (ends badges)-->
							
							<br />
															
							<div class="row">
								<label>&#218;ltimo curso aprobado:</label>
								<div class="span4">										
									<?php 
									if (amount_approved_courses_per_level($sid, 1) == 0) {
										echo "<strong>No ha aprobado ninguna clase.</strong>";
									}
									else {
										$last = last_approved_course($sid);
										echo '<strong>Clase:</strong> ' . $last['cname'] .'<br />';
										echo '<strong>A&#241;o:</strong> ' . $last['year'] .'<br />';
										echo '<strong>Semestre:</strong> ' . $last['sem_code'] .'<br />';
										
										//TODO: show options para matricular en proxima clase.
									}
									?>
								</div>
							</div><!-- /.row (ends last approved course) -->																
						</div><!-- /.span4 (ends second column) -->
					</div><!-- /.row -->					
				</div><!-- /first section -->
			</div>				
			<div class="row">
				<div class="span8">
					<h2 id="tabs">Cursos</h2>
					<ul class="nav nav-tabs">
				        <li class="active"><a href="#A" data-toggle="tab"><span class="badges">En Progreso</span></a></li>
				        <li><a href="#B" data-toggle="tab">Aprobados</a></li>
				        <li><a href="#C" data-toggle="tab">Reprobados</a></li>
		      		</ul>
					<div class="tabbable">
				        <div class="tab-content">
							<div class="tab-pane active" id="A">
				            	<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
									        <th>Clase</th>
									        <th>A&#241;o</th>
									        <th>Semestre</th>
									        <th>Sal&#243;n</th>
										</tr>
									</thead>
									<tbody>
										<!-- insert body here -->
										<?php 
										$in_progress_list = get_in_progress_courses($sid);
									
										foreach ($in_progress_list as $i) {
											echo "<tr>";
											echo "<td>".$i['cname']."</td>";
											echo "<td>".$i['year']."</td>";
											echo "<td>".$i['sem_code']."</td>";
											echo "<td>".$i['rid']."</td>";
											echo "</tr>";
										}											
										?>
									</tbody>
								</table><!-- /table -->
				          	</div>
							<div class="tab-pane" id="B">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
									        <th>Clase</th>
									        <th>A&#241;o</th>
									        <th>Semestre</th>
									        <th>Sal&#243;n</th>
										</tr>
									</thead>
									<tbody>
										<!-- insert body here -->
										<?php 
										$approved_list = get_approved_courses($sid);
									
										foreach ($approved_list as $a) {
											echo "<tr>";
											echo "<td>".$a['cname']."</td>";
											echo "<td>".$a['year']."</td>";
											echo "<td>".$a['sem_code']."</td>";
											echo "<td>".$a['rid']."</td>";
											echo "</tr>";
										}											
										?>
									</tbody>
								</table><!-- /table -->
							</div>
							<div class="tab-pane" id="C">
					        	<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
									        <th>Clase</th>
									        <th>A&#241;o</th>
									        <th>Semestre</th>
									        <th>Sal&#243;n</th>
										</tr>
									</thead>
									<tbody>
										<!-- insert body here -->
										<?php 
										$failed_list = get_failed_courses($sid);
									
										foreach ($failed_list as $f) {
											echo "<tr>";
											echo "<td>".$f['cname']."</td>";
											echo "<td>".$f['year']."</td>";
											echo "<td>".$f['sem_code']."</td>";
											echo "<td>".$f['rid']."</td>";
											echo "</tr>";
										}											
										?>
									</tbody>
								</table><!-- /table -->
					        </div>
						</div>
					</div> <!-- /.tabbable -->
				</div><!-- /.span8 -->		
			</div>				
		</div>
		<div class="span2"></div>		
		
	</div><!-- /.row -->
	<?php
	}
?>		

<?php include 'template/footer.php' ?>
