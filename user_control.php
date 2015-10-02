<?php
	require('includes/connect.inc.php');
	session_start();
	header('Content-Type: application/json');


	if( !check($_SESSION['email']) || !check($_POST['action']) ){
		terminate(ERR::SERVER_NODATA);
	}
	$email = $_SESSION['email'];

	$serialQuery = $link->query("SELECT `serials` FROM `users` WHERE `email`='$email'") or terminate(ERR::QUERY_CODE);
	$serials_str=getObj($serialQuery)->serials;
	$serials_arr=array_filter(explode(',',$serials_str));

	switch($_POST['action']){
		case 'addBoard':
			if(!check($_POST['name']) || !check($_POST['serial']) || !check($_POST['location']) || !check($_POST['sensitivity']) || !check($_POST['status']))
				terminate(ERR::SERVER_NODATA);
			$serial = $_POST['serial'];
			$board_query = $link->query("SELECT * FROM `boards` WHERE `serial`='$serial'") or terminate(ERR::QUERY_CODE);
			$board = getObj($board_query,ERR::BOARD_SERIAL);

			$name=$_POST["name"];
			$location=$_POST["location"];
			$sensitivity=intval($_POST["sensitivity"]);
			$status=$_POST["status"];

			if (strpos($serials_str,$serial) !== false) {
			    terminate(ERR::USER_HASSERIAL);
			}else{	
				array_push($serials_arr, $serial);
			}
			$serials_str=implode(',',$serials_arr);

			$updateUser=$link->query("UPDATE `users` SET `serials`='$serials_str' WHERE `email`='$email'") or terminate(ERR::QUERY_CODE);
			
			$status=='true' ? $num=1 : $num=0;
			$updateBoard=$link->query("UPDATE `boards` SET `location`='$location',`sensitivity`='$sensitivity',`status`=$num,`name`='$name' WHERE `serial`='$serial'") or terminate(ERR::QUERY_CODE);
			terminate();
		case 'deleteBoard':
			if(!check($_POST['serial']))
				terminate(ERR::SERVER_NODATA);
			$serial = $_POST['serial'];
			$board_query = $link->query("SELECT * FROM `boards` WHERE `serial`='$serial'") or terminate(ERR::QUERY_CODE);
			$board = getObj($board_query,ERR::BOARD_SERIAL);

			if (strpos($serials_str,$serial) === false) {
			    terminate(ERR::USER_NOSERIAL);
			}else{	
				if(($key = array_search($serial, $serials_arr)) !== false) {
				    unset($serials_arr[$key]);
				}else{
					terminate(ERR::USER_SERIAL);
				}
			}
			$serials_str=implode(',',$serials_arr);
			$updateUser=$link->query("UPDATE `users` SET `serials`='$serials_str' WHERE `email`='$email'") or terminate(ERR::QUERY_CODE);
			terminate();
		case 'getBoards':
			$boards = array();
			foreach ($serials_arr as &$value) { // iterate over serials and get board data.
				$query = $link->query("SELECT * FROM `boards` WHERE `serial`='$value'") or terminate(ERR::QUERY_CODE);
				if($query->num_rows==0){
					terminate(ERR::BOARD_SERIAL);
				}else{
					$obj = getObj($query);
			        $board=array(
			        	'name' => $obj->name,
			        	'location' => $obj->location,
			        	'serial' => $obj->serial,
			        	'status' => (bool)$obj->status
			        );
			        array_push($boards, $board);
			    }
			}
			exit(json_encode(array(
				'status'=>true,
				'boards'=>$boards
			)));
	}

?>