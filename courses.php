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
			<div class="row"><!-- Display forms for each course. -->
				<div class="span1"></div>
				<div class="span10">
					<?php
					$courses_list = get_courses();
					foreach ($courses_list as $c) {						
						?>
						<!-- Show forms for each course. -->
						<div class="row" style="border-top:1px solid #eee; padding-top:20px;">
							<div class="span2">
								<h4><strong><?php echo $c['name']; ?></strong></h4>								
							</div><!-- /.span3 -->
							<div class="span8">
								<form class="form-search" method="post" action="add-section.php">
									<input type="hidden" name="cid" value="<?php echo $c['cid']; ?>" />
									<select class="span2" name="tid">
										<option value=333>Maestros</option>	
										<?php
										$teachers_list = get_teachers();
										foreach ($teachers_list as $t) {								
											echo "<option value=". $t['tid'] .">". get_teacher_fullname($t['tid']) ."</option>";								
										}						
										?>										
									</select>
									<select class="span2" name="rid">
										<option value=333>Sal&#243;n</option>	
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
											<input class="span1" type="radio" name="did" value="<?php echo $d['did']; ?>" <?php if ($flag++ == 0) echo "checked"; ?>>
											<?php echo $d['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;									
										</label>
										
						            	<?php 
						            }
						            
						            ?>

									<input type="submit" name="add_submit" value="A&#241;adir" class="btn btn-warning btn-mini" />
							    </form><!-- /form -->
							</div><!-- /.span8 -->
						</div><!-- /.row -->
						<!-- Show sections of current year and semester for each course -->
						<div class="row">
							<div class="span2">
							</div>
							<div class="span8">
								<table class="table table-bordered table-condensed">
									<thead>
										<tr>
									        <th>Maestro</th>
									        <th>Sal&#243;n</th>									        
									        <th>D&#237;a</th>									        
									        <th>Remover</th>									        
										</tr>
									</thead>
									<tbody>
										<!-- insert body here -->
										<!-- loop these row$_POST['tid']s -->
										<?php 
										$sections_list = get_current_sections($c['cid']);
									
										foreach ($sections_list as $s) {
											echo "<tr>";
											echo "<td>".get_teacher_fullname($s['tid'])."</td>";
											echo "<td>".$s['rid']."</td>";
											echo "<td>".$s['Day']."</td>";
											echo "<td><a href=delete-section.php?sec_id=".$s['sec_id']."><i class=icon-remove></i></a></td>";
											echo "</tr>";
										}
										
										
										?>
										
									</tbody>
								</table>
							</div>
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