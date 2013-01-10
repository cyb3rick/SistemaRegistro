<?php include 'core/init.php' ?>
<?php include 'template/header.php' ?>
<?php include 'template/includes/widgets/login_modal.php' ?> <!-- login modal -->

<?php 
	/* If not logged in, show login box instead. */
	if (!logged_in()) { include 'template/includes/widgets/login_box.php'; }
	else {
	?>
	<!-- show stats and the coolest search box -->
	<div class="row">
		<div class="span12">
			<h1 id="tabs">Reportes</h1>
			<br />		
			<br />		
		</div><!-- /.span12 -->		
	</div><!-- /.row -->
			
	<!-- Main hero unit for a primary marketing message or call to action -->
	<script type="text/javascript">
	      google.load("visualization", "1", {packages:["corechart"]});
	      google.setOnLoadCallback(drawChart);
	      function drawChart() {
	        var data = google.visualization.arrayToDataTable([
	          ['Año', 'Activos', 'Inactivos', 'Graduandos'],
	          ['2008',  1000,      400,			125],
	          ['2009',  1170,      460,			425],
	          ['2010',  660,       1120,			455],
	          ['2011',  1030,      540,			525]
	        ]);
	
	        var options = {
	          title: 'Miembros del Instituto Biblico',
	          hAxis: {title: 'Ano', titleTextStyle: {color: 'red'}}
	        };
	
	        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
	        chart.draw(data, options);
	      }
	</script>
	<div class="row">		
		<div class="span12" style="margin-left:0; height:300px;" id="chart_div"></div>		
	</div><!-- ends hero-unit -->
	
	<div class="row">
		<div class="span4">
			<h2>Activos</h2>
          	<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
         	<p><a class="btn" href="#">View details &raquo;</a></p>
        </div>
        <div class="span4">
          	<h2>Inactivos</h2>
          	<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          	<p><a class="btn" href="#">View details &raquo;</a></p>
       	</div>
        <div class="span4">
          	<h2>Graduandos</h2>
          	<p>Estudiantes con menos de 2 cursos restantes por graduarse.</p>
          	<p><a class="btn" href="seniors.php">Ver Lista &raquo;</a></p>
        </div>
	</div><!-- ends row -->
	<?php
	}
?>				

<?php include 'template/footer.php' ?>
