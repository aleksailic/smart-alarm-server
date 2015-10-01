<?php
	function redirect($addr){
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

		header("Location: http://$host$uri/$addr");
		die();
	}
?>