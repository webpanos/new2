<?php
include 'config.php';

	$temp =array("33", "99") ; 
	$tempOrder = array_values($temp); 

	
	echo '{"numOfProperties":'. json_encode($tempOrder) .'}'; 



?>