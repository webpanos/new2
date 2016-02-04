<?php
include 'configRem.php';

/* initialize the variables */
		$numberStudios = $numberHotels = $numberHouses  = 0 ;
		$numberChora = $numberGialos = $numberLivadi = $numberMaltezana = 0 ;

		$totalAccommodation = 0 ;

$sql = "SELECT pID, pName, pMainPhotoNew, pArea, pCategory FROM properties WHERE pCategory<10 AND pPayment>=5";

try {
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->query($sql);  

		while($row = $stmt->fetch( PDO::FETCH_ASSOC )){ 
			
					$totalAccommodation ++ ;
			if ($row['pCategory'] ==1) $numberStudios++ ;
			else if ($row['pCategory'] ==2) $numberHotels++ ;
			else if ($row['pCategory'] ==3) $numberHouses++ ;

			if ($row['pArea'] ==1) $numberChora++ ;
			else if ($row['pArea'] ==2) $numberGialos++ ;
			else if ($row['pArea'] ==3) $numberLivadi++ ;
			else if ($row['pArea'] ==4) $numberMaltezana++ ;

/*			 print $row['pID'] . ' - ' . $row['pName'].'<br>'; 
*/		}
/*			 print 'studios=' . $numberStudios . '  -- hotels=' . $numberHotels ;
*/
		$numOfProperties['studios'] = $numberStudios ;
		$numOfProperties['hotels'] = $numberHotels ;
		$numOfProperties['houses'] = $numberHouses ;

	$numOfProperties = (object) $numOfProperties;

	$dbh = null;
	echo '{"numOfProperties":'. json_encode($numOfProperties) .'}<br/>'; 
} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}


?>