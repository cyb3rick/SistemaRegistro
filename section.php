<?php include 'core/init.php' ?>
<?php include 'template/header.php' ?>
<?php include 'template/includes/widgets/login_modal.php' ?> <!-- login modal -->

<?php 
	/* If not logged in, show login box. */
	if (!logged_in()) { include 'template/includes/widgets/login_box.php'; }
	else if ( !isset($_GET['sec_id']) OR !section_exists($_GET['sec_id']) ) { // sec_id is not valid.
		?>
		<!-- Display invalid section id error. -->
		<div class="row">
			<div class="span12">
				<h1>Secci&#243;n</h1>
				<br />		
				<br />
				<div class="span2"></div>
				<div class="span8">
					<div class='alert'>
						Error: La secci&#243;n solicitada no existe.<button type='button' class='close' data-dismiss='alert'> <i class="icon-remove"></i> </button>
					</div>
					<a href='.' class='btn btn-large'><i class="icon-chevron-left icon-white"></i> Inicio</a>
				</div>
				<div class="span2"></div>
			</div><!-- /.span12 -->
		</div><!-- /.row -->	
		<?php 
	}
	else { // sec_id is valid -> do cool stuff.
		
		$sec_id = $_GET['sec_id'];
		
		// Store section data.
		$section_data = section_data($sec_id, "sec_id", "cid", "tid", "rid", "did", "sem_code", "year"); 
		$course_data = get_course_from_section($sec_id);
		$teacher_data = teacher_data($section_data['tid'], 'first_name', 'middle_name', 'last_name', 'phone', 'cellphone', 'email'); // TODO: get picture url
		?>
		<div class="row">
			<div class="span2"></div>
			<div class="span8"><!-- middle content -->				
				<h1>
					<?php echo $course_data['cname']; ?>
				</h1>
			
				<p>
					<strong>Ano:</strong> <?php echo $section_data['year']; ?> | 
					<strong>Semestre:</strong> <?php echo $section_data['sem_code']; ?> | 
					<strong>Salon:</strong> <?php echo $section_data['rid']; ?>
				</p>
			</div>
			<div class="span2"></div>
		</div>
		<div class="row">
			<div class="span2"></div>
			<div class="span8"><!-- middle content (2nd row) -->
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
					        <th>Nombre</th>
					    	<th>Estatus</th>
					        <th>Acci&#243;n</th>
						</tr>
					</thead>
					<tbody>
						<!-- insert body here -->
						<?php 

						$students_list = get_students_from_section($sec_id);
						
						foreach ($students_list as $s) {
							echo "<tr>";
							echo "<td>".get_student_fullname($s['sid'])."</td>";
							echo "<td>Paso</td>";
							echo "<td><a class='btn btn-mini btn-primary' href=students.php?sid=".$s['sid'].">Ver Perfil <i class='icon-user icon-white'></i></a></td>";									
							echo "</tr>";
						}											
						?>
					</tbody>
				</table><!-- /table -->			
			</div>
			<div class="span2"></div>
		</div><!-- /.row -->
	
	
		<?php
	}
?>				

<?php include 'template/footer.php' ?>