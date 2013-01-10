<?php include 'core/init.php' ?>

<p id="searchresults">
<?php
	// Is there a posted query string?
	if(isset($_POST['queryString'])) {
		$queryString = mysql_escape_string($_POST['queryString']);
		
		// Is the string length greater than 0?
		if(strlen($queryString) >0) {
			$query = mysql_query("SELECT sid, first_name, middle_name, last_name, email, phone, cellphone FROM Students WHERE first_name LIKE '%". $queryString . "%' OR last_name LIKE '%". $queryString . "%' OR email LIKE '%". $queryString . "%' OR phone LIKE '%". $queryString . "%' OR cellphone LIKE '%". $queryString . "%' OR middle_name LIKE '%". $queryString . "%' ORDER BY last_name LIMIT 8");
			
			
			if($query) {
				// While there are results loop through them - fetching an Object.
				
				?>
				
				<table class="table table-striped table-hover">
					<thead>
						<tr>						    	
					        <th>Nombre Completo</th>
					        <th>Teléfono</th>
					        <th>Celular</th>
					        <th>Correo Electrónico</th>
					        <th>Editar <i class="icon-pencil"></i></th>
						</tr>
					</thead>
					<tbody>

				
				<?php 					
				echo "<tr class='info'><td><strong>Students</strong></td><td></td><td></td><td></td><td></td></tr>";
				while ( $row = mysql_fetch_assoc($query) ) {						
					$name = $row['first_name'] . ' ' . $row['last_name'];
					if(strlen($name) > 35) {
						$name = substr($name, 0, 35) . "...";
					}
					echo "<tr>";
					echo "<td>".$name."</td>";
					echo "<td>".$row['phone']."</td>";
					echo "<td>".$row['cellphone']."</td>";
					echo "<td>".$row['email']."</td>";
					echo "<td><a class='btn btn-mini btn-info' href='students.php?sid=".$row['sid']."'>Ver Perfil <i class='icon-user icon-white'></i></a></td>";
					echo "</tr>";
         		}
         		
         		echo "<tr class='success'><td><strong>Teachers</strong></td><td></td><td></td><td></td><td></td></tr>";
         		
         		$query = mysql_query("SELECT tid, first_name, middle_name, last_name, email, phone, cellphone FROM Teachers WHERE first_name LIKE '%". $queryString . "%' OR last_name LIKE '%". $queryString . "%' OR email LIKE '%". $queryString . "%' OR phone LIKE '%". $queryString . "%' OR cellphone LIKE '%". $queryString . "%' OR middle_name LIKE '%". $queryString . "%' ORDER BY last_name LIMIT 8");
				while ( $row = mysql_fetch_assoc($query) ) {						
					$name = $row['first_name'] . ' ' . $row['last_name'];
					if(strlen($name) > 35) {
						$name = substr($name, 0, 35) . "...";
					}
					echo "<tr>";
					echo "<td>".$name."</td>";
					echo "<td>".$row['phone']."</td>";
					echo "<td>".$row['cellphone']."</td>";
					echo "<td>".$row['email']."</td>";
					echo "<td><a class='btn btn-mini btn-success' href='teachers.php?tid=".$row['tid']."'>Ver Perfil <i class='icon-user icon-white'></i></a></td>";
					echo "</tr>";
         		}
         		?>
         			</tbody><!-- /tbody -->
         		</table><!-- /table -->
         		<?php 
			} else {
				echo 'ERROR: There was a problem with the query.';
			}
		} else {
			// Dont do anything.
		} // There is a queryString.
	} else {
		echo 'There should be no direct access to this script!';
	}
?>
</p>