<?php
	require('connect.inc.php');
	if(  !isset( $_POST['serial'] ) || empty( $_POST['serial'] )){
		die();
	}
	$serial = $link->escape_string($_POST['serial']);
	$query = $link->query("SELECT * FROM `boards` WHERE `serial`='$serial'") or die("Error executing query");
	if($query->num_rows==0){
		die("Incorrect data passed");
	}else if($query->num_rows==1){
		$obj=$query->fetch_object(); //fetch the user object
		$status=$obj->status;
	}else{
		die("Error in DB, multiple boards with the same serial key");
	}

	$encode=array("status"=>$status);
	header('Content-Type: application/json');
	echo json_encode($encode);

?>