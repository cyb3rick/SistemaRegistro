<?php
session_start();
session_destroy();
header('Location: .'); // redirects us to main directory (where index.php is...)
?>
