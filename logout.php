<?php
	require('includes/redirect.inc.php');
	session_start();
	session_unset();
	session_destroy();
	redirect('index.php');
?>