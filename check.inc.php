<?php
function check(&$var){
	require('connect.inc.php');
	if(!isset($var) || empty($var)){
		return false;
	}else{
		$var = $link->escape_string($var);
		return true;
	}
}
?>