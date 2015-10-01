<?php
	require('errors.inc.php');

	$mysqli_host = 'localhost';
	$mysqli_username = 'test';
	$mysqli_password = 'ZRj6QJeaaGxsFceJ';
	$mysqli_db='alarm';


	$link= new mysqli($mysqli_host,$mysqli_username,$mysqli_password,$mysqli_db) or die("Error connecting to the database");

	function check(&$var){
		global $link;
		if(!isset($var) || empty($var)){
			return false;
		}else{
			$var = $link->escape_string($var);
			return true;
		}
	}
	function getObj(&$query,$ERR_NODATA=false,$ERR_MANYDATA=false){
		if($query->num_rows==0){ //NO
			$ERR_NODATA ? terminate(ERR::QUERY_NORESULT,$ERR_NODATA) : terminate(ERR::QUERY_NORESULT);
		}else if($query->num_rows==1){
		   return $query->fetch_object();
		}else{
			$ERR_MANYDATA ? terminate(ERR::QUERY_RESULT_LENGTH,$ERR_MANYDATA) : terminate(ERR::QUERY_RESULT_LENGTH);
		}
	}
?>
