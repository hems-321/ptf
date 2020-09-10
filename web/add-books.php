<?php
	require_once ("class/DBController.php");
	require_once ("class/Router.php");
	if (defined('STDIN')) {
	  $num = (int)readline('Please enter number of routers to be inserted: ');
	} else { 
	  $num = $_GET['num'];
	}

	$router = new Router();
	$cnt = 1;
	for($i=0;$i<$num;$i++){
		$mac_addr = 'mac-'.$cnt;
		if( !$router->validateMacAddress($mac_addr)){
			$num++;
			$cnt++;
		}
		$sap_id = 'sap_id'.$cnt;
		$host_name = 'host'.$cnt.'.com';
		$loop_back = 'loopback-'.$cnt;
		$router->addRouter($sap_id,$host_name,$loop_back,$mac_addr);
	}

?>