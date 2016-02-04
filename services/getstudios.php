<?php
include 'config.php';

if (!isset($_GET['cat'])) $category=0 ;
else $category = $_GET['cat'] ;

if (!isset($_GET['area'])) $area=0 ;
else $area = $_GET['area'] ;

$category = (int) $category;

$sql = "SELECT pID, pName, pMainPhotoNew, pArea, pCategory FROM properties WHERE pCategory=" . $category . " AND pPayment>=5";

try {
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->query($sql);  
	$properties = $stmt->fetchAll(PDO::FETCH_OBJ);
	$dbh = null;
	echo '{"studios":'. json_encode($properties) .'}'; 
} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}


?>