<?php
include 'config.php';

if (!isset($_GET['cat'])) $category=0 ;
else $category = $_GET['cat'] ;

if (!isset($_GET['area'])) $area=0 ;
else $area = $_GET['area'] ;

$category = (int) $category;
$area = (int) $area;

if($category!=0)
$sql = "SELECT pID, pName, pMainPhotoNew, pArea, pCategory FROM properties WHERE pCategory=" . $category . " AND pPayment>=5";

if($area!=0)
$sql = "SELECT pID, pName, pMainPhotoNew, pArea, pCategory FROM properties WHERE pArea=" . $area . " AND pCategory<6 AND pPayment>=5";

$myfile = fopen("log.txt", "w") or die("Unable to open file!");
fwrite($myfile, $area);

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