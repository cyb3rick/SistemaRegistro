<?php include 'core/init.php' ?>
<?php include 'template/header.php' ?>
<?php include 'template/includes/widgets/login_modal.php' ?> <!-- login modal -->

<?php 
	/* If not logged in, show login box instead. */
	if (!logged_in()) { include 'template/includes/widgets/login_box.php'; }
	else if ( !isset($_GET['sid']) OR !student_exists($_GET['sid']) ) {
	?>
	<div class="row">
		<div class="span12">
			<h1>Estudiante</h1>
			<br />		
			<br />
			<div class="span2"></div>
			<div class="span8">
				<div class='alert'>
					Error: El sid provisto es invalido o no proveyó ninguno.<button type='button' class='close' data-dismiss='alert'> × </button>
				</div>
				<a href='.' class='btn btn-large'><i class="icon-chevron-left icon-white"></i> Regresar</a>
			</div>
			<div class="span2"></div>
		</div><!-- /.span12 -->
	</div><!-- /.row -->
	
	<?php 
	}
	else {
		
		// Store and sanitize passed in sid.
		$sid = mysql_real_escape_string($_GET['sid']);
	
		// Get all data from student.
		$student_data = student_data($sid, 'first_name', 'middle_name', 'last_name', 'phone', 'cellphone', 'email');
		
	?>
	<!-- show stats and the coolest search box -->
	<div class="row">
		<div class="span12">
			<h1>
				<?php 
				if ( empty($student_data['middle_name']) ) {
					echo $student_data['first_name'] . " " . $student_data['last_name'];
				}
				else {
					echo $student_data['first_name'] . " " . $student_data['middle_name'] . " " . $student_data['last_name'];
				} 
				?>
				
			</h1>
			<h4>Estudiante</h4>
			<br />		
			<br />
			<div class="span2"></div>
			<div class="span8">
				<div class="row">
					<div class="span8"><!-- first section -->
						
						<div class="row">
							<div class="span6"></div>
							<div class="span2">
								<div class="btn-group">
					                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
					                <ul class="dropdown-menu">
					                	<li><a href="#">Action 1</a></li>
					                  	<li><a href="#">Action 2</a></li>
					                  	<li class="divider"></li>
					                  	<li><a href="#">Separated link</a></li>
					                </ul>
					            </div><!-- /btn-group -->
								<a href="<?php echo $_SERVER['PHP_SELF'] . "?sid=" . $sid; ?>" class="btn">Cancelar</a>
							
							</div>
						</div><!-- /.row -->
						
						<div class="row">
							<div class="span4">
								
								<form>
								
									<div class="control-group">
							   			<label class="control-label">Nombre</label>
							    		<div class="controls">
							    			<input type="text" name="first_name" value="<?php echo $student_data['first_name']; ?>">
							    		</div>
							    	</div>
							    	
							    	<div class="control-group">
							   			<label class="control-label">Segundo Nombre</label>
							    		<div class="controls">
							    			<input type="text" name="last_name" value="<?php echo $student_data['middle_name']; ?>">
							    		</div>
							    	</div>
							    	
							    	<div class="control-group">
							   			<label class="control-label">Apellido</label>
							    		<div class="controls">
							    			<input type="text" name="middle_name" value="<?php echo $student_data['last_name']; ?>">
							    		</div>
							    	</div>
							    	
							    	<div class="control-group">
							   			<label class="control-label">Teléfono Residencial</label>
							    		<div class="controls">
							    			<input type="text" name="phone" value="<?php echo $student_data['phone']; ?>">
							    		</div>
							    	</div>
							    	
							    	<div class="control-group">
							   			<label class="control-label">Celular</label>
							    		<div class="controls">
							    			<input type="text" name="cellphone" value="<?php echo $student_data['cellphone']; ?>">
							    		</div>
							    	</div>
							    	
							    	<div class="control-group">
							   			<label class="control-label">Correo Eletrónico</label>
							    		<div class="controls">
							    			<input type="text" name="email" value="<?php echo $student_data['email']; ?>">
							    		</div>
							    	</div>
							    	
							    	<div class="control-group">
							    		<label>Apuntes</label>
							    		<div class="controls">
							    			<textarea rows="3"></textarea>
							    		</div>
							    	</div>
							    	
							   		<div class="control-group">
							    		<div class="controls">
							    		
							    			<button type="submit" class="btn btn-large btn-success">Guardar Cambios</button>
							   			</div>
							    	</div>
							    	
							    	
							    </form><!-- /form -->	
							    					
							</div><!-- /.span4 -->
							
							<div class="span4">
								<label>Logros Académicos</label>
								<br />
								<div class="row">
									<div class="span2"><img style="max-width:150px;" src="assets/img/level1-badge.png" alt="Level 1"></div>
									<div class="span2"><img style="max-width:150px;opacity:0.3" src="assets/img/level2-badge.png" alt="Level 1"></div>
								</div>
								<br />
								<div class="row">
									<div class="span2"><img style="max-width:150px;" src="assets/img/level1-badge.png" alt="Level 1"></div>
									<div class="span2"></div>
								</div>
								
							</div><!-- /.span4 -->
						</div><!-- /.row -->					
					</div><!-- /first section -->
				</div>				
				<div class="row">
					<div class="span8">
						<h2 id="tabs">Cursos</h2>
						<ul class="nav nav-tabs">
					        <li class="active"><a href="#A" data-toggle="tab"><span class="badge badge-success">Aprovados</span></a></li>
					        <li><a href="#B" data-toggle="tab"><span class="badge badge-important">Reprovados</span></a></li>
					        <li><a href="#C" data-toggle="tab">Todos</a></li>
			      		</ul>
						<div class="tabbable">
					        <div class="tab-content">
								<div class="tab-pane active" id="A">
					            	<p>I'm in Section A.</p>
					          	</div>
								<div class="tab-pane" id="B">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
										        <th>Clase</th>
										        <th>Año</th>
										        <th>Semestre</th>
										        <th>Salón</th>
											</tr>
										</thead>
										<tbody>
											<!-- insert body here -->
											<tr>												
												<td></td>
												<td></td>
												<td></td>
												<td></td>												
											</tr>
										</tbody>
									</table>
								</div>
								<div class="tab-pane" id="C">
						        	<p>What up girl, this is Section C.</p>
						        </div>
							</div>
						</div> <!-- /.tabbable -->
					</div><!-- /.span8 -->		
				</div>				
			</div>
			<div class="span2"></div>		
		</div><!-- /.span12 -->		
	</div><!-- /.row -->
	<?php
	}
?>		

<?php include 'template/footer.php' ?>
