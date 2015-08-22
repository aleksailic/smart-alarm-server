<?php
	require('redirect.inc.php');
	session_start();
	session_unset();
	session_destroy();
	redirect('login.php');
?>