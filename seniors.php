<?php include 'core/init.php' ?>
<?php include 'template/header.php' ?>
<?php include 'template/includes/widgets/login_modal.php' ?> <!-- login modal -->

<?php 
	/* If not logged in, show login box. */
	if (!logged_in()) { include 'template/includes/widgets/login_box.php'; }
	else {
		?>
		
		
		<div class="row">
			<div class="span2"></div>
			<div class="span8">
				<h1>Graduandos</h1>
			</div>
			<div class="span2"></div>		
		</div><!-- /.row -->
		
		<div class="row">
		
			<div class="span2"></div>
			<div class="span4"> <!-- tabla de nivel 1 -->
				<h3>Nivel 1</h3>			
				<table class="table table-hover table-condensed">
					<thead>
						<tr>
					        <th>Estudiante</th>
					        <th>Ver Perfil</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						// 
						$students_list = get_all_students();
						$num_courses_level_1 = amount_of_courses_per_level(1);
						$num_courses_level_2 = amount_of_courses_per_level(2);
						
						foreach ($students_list as $s) {			
							// level 1
							
							// get approved courses
							$num_approved_courses = amount_approved_courses_per_level($s['sid'], 1);
							$num_courses_lacking = $num_courses_level_1 - $num_approved_courses;
							
							if ( ($num_courses_lacking <= 4) && ($num_courses_lacking !== 0) ) {
								// es graduando!!!
								echo "<tr>";
								echo "<tr><td>".get_student_fullname($s['sid'])."</td><td><a class='btn btn-mini btn-primary' href=students.php?sid=".$s['sid'].">Ver Perfil</a></td>";
								echo "</tr>";
							}
						}
						?>
					</tbody>
				</table><!-- /table -->
			</div><!-- /.span4 -->
		
			<div class="span4">
				<h3>Nivel 2</h3>
				<table class="table table-hover table-condensed">
					<thead>
						<tr>
					        <th>Estudiante</th>
					        <th>Ver Perfil</th>
						</tr>
					</thead>
					<tbody>
						<?php 						
						foreach ($students_list as $s) {				
							// level 2
							
							// get approved courses
							$num_approved_courses = amount_approved_courses_per_level($s['sid'], 2);
							$num_courses_lacking = $num_courses_level_2 - $num_approved_courses;
							
							if ( ($num_courses_lacking <= 1) && ($num_courses_lacking !== 0) ) {
								// es graduando!!!				
								echo "<tr>";
								echo "<tr><td>".get_student_fullname($s['sid'])."</td><td><a class='btn btn-mini btn-info' href=students.php?sid=".$s['sid'].">Ver Perfil</a></td>";
								echo "</tr>";
							}
						}	
						?>
					</tbody>
				</table><!-- /table2 -->
			</div><!-- /.span4 -->
			<div class="span2"></div>		
		</div><!-- /.row -->
		
		<?php
	}
?>				

<?php include 'template/footer.php' ?>