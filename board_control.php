<?php
	require('includes/connect.inc.php');
	header('Content-Type: application/json');

	if( !check($_GET['serial']) || !check($_GET['action']) ){
		terminate(ERR::SERVER_NODATA);
	}
	$serial =$_GET['serial'];

	$board_query = $link->query("SELECT * FROM `boards` WHERE `serial`='$serial'") or terminate(ERR::QUERY_CODE);
	$board = getObj($board_query,ERR::BOARD_SERIAL);

	switch($_GET['action']){
		case 'getData':
			$user_query= $link->query("SELECT * FROM `users` WHERE `serials` LIKE '%$serial%'") or terminate(ERR::QUERY_CODE);
			$users=array();
			if($user_query->num_rows==0){
				terminate(ERR::USER_NOSERIAL);
			}else{
				while($user = $user_query->fetch_assoc()){
					array_push($users,array(
						'email'=>$user['email'],
						'name'=>$user['name'],
						'surname'=>$user['surname']
					));
				}
			}
			$encode=array("status"=>$board->status,"name"=>$board->name,"location"=>$board->location,"sensitivity"=>$board->sensitivity,"users"=>$users);
			exit(json_encode($encode));
		case 'isActive':
			$encode=array("status"=>$board->status);
			exit(json_encode($encode));
		case 'addLog':
			if(!check($_GET['log']))
				terminate(ERR::SERVER_DATA);
			$insertLog=$link->query("INSERT INTO `logs` `board` VALUES '$serial'") or terminate(ERR::QUERY_CODE);
			terminate();
		case 'setStatus':
			if( !check($_GET['value']) )
				terminate(ERR::SERVER_DATA);

			$status=intval($_GET["value"]);
			$status==1 ? $num=0 : $num=1;

			$updateBoard=$link->query("UPDATE `boards` SET `status`=$num WHERE `serial`='$serial'") or terminate(ERR::QUERY_CODE);
			$encode=array("passed"=>true,"error"=>"");
			exit (json_encode($encode));
		case 'toggleStatus':
			$status=intval($board->status);
			$status==1 ? $num=0 : $num=1;
			$updateBoard=$link->query("UPDATE `boards` SET `status`=$num WHERE `serial`='$serial'") or terminate(ERR::QUERY_CODE);
			terminate();
		case 'getLog':
			$log_query = $link->query("SELECT * FROM `logs` WHERE `board`='$serial' ORDER BY `id` DESC LIMIT 20 ") or terminate(ERR::QUERY_CODE);
			$logs = array();
			while($log = $log_query->fetch_assoc()){
				array_push($logs, array(
					'message' => $log['message'],
					'timestamp' => $log['timestamp']
				));
			}
			exit(json_encode($logs));
	}
?>