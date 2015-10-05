<?php 
	abstract class ERR
	{
	    const DB_CONNECT = "ERR_DB_CONNECT";
	    const QUERY_CODE = "ERR_QUERY_CODE";
	    const QUERY_NORESULT = "ERR_QUERY_NORESULT";
	    const QUERY_RESULT_LENGTH = "ERR_QUERY_RESULT_LENGTH";
	    const SERVER_NODATA = "ERR_SERVER_NODATA";
	    const SERVER_DATA = "ERR_SERVER_DATA";

	    const USER_NOSERIAL="ERR_USER_NOSERIAL";
	    const USER_SERIAL = "ERR_USER_SERIAL";
	    const USER_HASSERIAL = "ERR_USER_HASSERIAL";
	    const BOARD_SERIAL = "ERR_BOARD_SERIAL";
	}
	class LOCALE{
		public static $SERBIA=array(
			'ERR_DB_CONNECT' => "Podaci za povezivanje sa bazom su netacni",
			'ERR_QUERY_CODE' => "Greska u izvrsivanju upita",
			'ERR_QUERY_NORESULT' => "Nema podataka u bazi",
			'ERR_QUERY_RESULT_LENGTH' => "Upit vratio vise no što treba. Greska u bazi podataka",
			'ERR_SERVER_NODATA' => "Nedovoljno podataka prosledjeno",
			'ERR_SERVER_DATA' => "Prosledjeni podaci ne odgovaraju bazi",
			'ERR_USER_NOSERIAL' => "Korisnik nema SmartAlarm u bazi",
			'ERR_USER_SERIAL' => "Neodgovarajuci serijski broj",
			'ERR_USER_HASSERIAL' => "SmratAlarm sa prosledjenim serijskim brojem je vec dodat korisniku.",
			'ERR_BOARD_SERIAL' => "Nepostojeci serijski broj prosledjen"
		);
	}
	function terminate(){
		$errors=array();
		$status=true;
		if(func_num_args()>0){
			$status=false;
			$args = func_get_args();
			foreach ($args as $arg) {
				array_push($errors, array(
					'code'=>$arg,
					'message'=>LOCALE::$SERBIA[$arg]
				));
			}
		}
		exit(json_encode(array(
			'status'=>$status,
			'errors'=>$errors
		)));

	}
?>