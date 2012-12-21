<h2>Log in/Register</h2>
<div class="inner">
<?php 
if (!logged_in()) { // user isn't logged in
	?>	
	<!-- html portion for non-logged in user -->
	<form action="/authSystem/login.php" method="post">
		<ul>
			<li>
				Username:<br />
				<input type="text" name="username" />				
			</li>
			<li>
				Password:<br />
				<input type="password" name="password" />
			</li>
			<li>
				<br />
				<input type="submit" value ="Log in" name="submit" />
			</li>
			<li>
				<br />
				<a href="/authSystem/register.php">Register</a>
			</li>
		</ul>
	</form>
	<!-- ENDS html portion for non-logged in user -->
	<?php
}
else {	// user's logged in	
	echo "<p>Welcome, " . $_SESSION['user_id'] . "!</p>";
	echo "<a href='/authSystem/logout.php'>Logout</a>"; //TODO: Find a way to remove absolute path.
}
?>	
</div> <!-- ENDS inner -->
