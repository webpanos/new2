<?php
    header('Access-Control-Allow-Origin: *');
	
    $callback = isset($_GET['callback']) ? preg_replace('/[^a-z0-9$_]/si', '', $_GET['callback']) : false;
    header('Content-Type: ' . ($callback ? 'application/javascript' : 'application/json') . ';charset=UTF-8');

	
try {
	
	$numOfProperties = array(28,99,4,1,0,"",16,7,5,6);

    echo ($callback ? $callback . '(' : '') . '{"numOfProperties":'. json_encode($numOfProperties) .'}' . ($callback ? ')' : '');
	

} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}



?>