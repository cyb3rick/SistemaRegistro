<?php include 'core/init.php' ?>
<?php include 'template/header.php' ?>
<?php include 'template/includes/widgets/login_modal.php' ?> <!-- login modal -->

<?php 
	/* If not logged in, show login box. */
	if (!logged_in()) { include 'template/includes/widgets/login_box.php'; }
	else {
	?>
	<!-- show stats and the coolest search box -->
	<div class="row">
		<div class="span12">
			<h1>Manejo de Secciones y Maestros</h1>
			<br />
			<br />
			<div class="row">
				<div class="span1"></div>
				<div class="span10">
					<?php
					$courses_list = get_courses();
					foreach ($courses_list as $c) {						
						?>
						<!-- Show forms for each course. -->
						<div class="row" style="border-top:1px solid #eee">
							<div class="span2">
								<strong><?php echo $c['name']; ?></strong></strong>
								
							</div><!-- /.span3 -->
							<div class="span8">
								<form class="well form-search" method="post" action="add-section.php">
									<select name="tid">
										<option>Maestros</option>	
										<?php
										$teachers_list = get_teachers();
										foreach ($teachers_list as $t) {								
											echo "<option value=". $t['tid'] .">". get_teacher_fullname($t['tid']) ."</option>";								
										}						
										?>										
									</select>
									<select name="rid">
										<option>Salón</option>	
										<?php
										$rooms_list = get_rooms();
										foreach ($rooms_list as $r) {								
											echo "<option value=". $r['rid'] .">". $r['rid'] ."</option>";								
										}						
										?>										
									</select>
						            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						            <?php 
						            $days_list = get_days();
						            $flag = 0;
						            foreach($days_list as $d) {
						            	?>
						            	<!-- Display days. -->
						            	<label class="radio">
											<input type="radio" name="optionsRadios" value="<?php echo $d['did']; ?>" <?php if ($flag++ == 0) echo "checked"; ?>>
											<?php echo $d['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;									
										</label>
										
						            	<?php 
						            }
						            
						            ?>
						            
									<button class="btn btn-warning pull-right" type="submit">Add <i class="icon-plus icon-white"></i></button>	
							    </form><!-- /form -->
							</div><!-- /.span8 -->
						</div><!-- /.row -->
						
						<?php 
					}						
					?>		
				</div>
				<div class="span1"></div>			
			</div>			
		</div>	
	</div>
	
	
	<?php
	}
?>				

<?php include 'template/footer.php' ?>