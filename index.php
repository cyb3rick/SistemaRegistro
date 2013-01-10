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
			<h1>Miembros</h1>
			<br />		
			<br />		
		</div><!-- /.span12 -->		
	</div><!-- /.row -->
			
	<!-- Main hero unit for a primary marketing message or call to action -->
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
	      google.load("visualization", "1", {packages:["corechart"]});
	      google.setOnLoadCallback(drawChart);
	      function drawChart() {
	        var data = google.visualization.arrayToDataTable([
	          ['Año', 'Activos', 'Inactivos', 'Graduandos'],	          
	          ['2008',  22000,      400,			125],
	          ['2009',  1170,      460,			425],
	          ['2010',  660,       1120,			455],
	          ['2011',  1030,      540,			525]
	        ]);
	
	        var options = {
	          title: 'Miembros del Instituto B&#237;blico',
	          hAxis: {title: 'A&#241;o', titleTextStyle: {color: 'red'}}
	        };
	
	        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
	        chart.draw(data, options);
	      }
	</script>
	<div class="row">
		<div class="span12" style="height:300px;" id="chart_div"></div>
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
          	<h2>Graduados</h2>
          	<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          	<p><a class="btn" href="#">View details &raquo;</a></p>
        </div>
	</div><!-- ends row -->
	<?php
	}
?>				

<?php include 'template/footer.php' ?>
