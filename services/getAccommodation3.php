<?php
//include 'config.php';
include 'configRem.php';


/* initialize the variables   */	
	$numberStudios = $numberHotels = $numberApartments = $numberMaisonettes= $numberHouses  = 0 ;
		$numberChora = $numberGialos = $numberLivadi = $numberMaltezana = 0 ;

		$totalAccommodation = 0 ;
 
$sql = "SELECT pArea, pCategory FROM properties WHERE pCategory<10 AND pPayment>=5";

try {
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->query($sql);  
	//$properties = $stmt->fetchAll(PDO::FETCH_OBJ);
	$dbh = null;

		while($row = $stmt->fetch( PDO::FETCH_ASSOC )){ 
			
					$totalAccommodation ++ ;
			if ($row['pCategory'] ==1) $numberStudios++ ;
			else if ($row['pCategory'] ==2) $numberHotels++ ;
			else if ($row['pCategory'] ==3) $numberApartments++ ;
			else if ($row['pCategory'] ==4) $numberHouses++ ; 
			else if ($row['pCategory'] ==5) $numberMaisonettes++ ; 

			if ($row['pArea'] ==1) $numberChora++ ;
			else if ($row['pArea'] ==2) $numberGialos++ ;
			else if ($row['pArea'] ==3) $numberLivadi++ ;
			else if ($row['pArea'] ==4) $numberMaltezana++ ;
		}
		
		$numOfProperties = array($numberStudios,  $numberHotels, $numberApartments, $numberHouses, $numberMaisonettes, '', $numberChora, $numberGialos, $numberLivadi, $numberMaltezana );
		$numOfProperties = array_values($numOfProperties); 

/*	$temp =array("33", "99") ; 
	$tempOrder = array_values($temp); 
*/
	
	echo '{"numOfProperties":'. json_encode($numOfProperties) .'}'; 

} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}


?>