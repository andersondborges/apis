<?php
 
/*
$client = new SoapClient('http://ws.tradetracker.com/soap/affiliate?wsdl', array('compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP));
$client->authenticate(146342, 'd37defc2bb8ffae6a1cfdd309b056583e223a5dd');
 
foreach ($client->getAffiliateSites() as $affiliateSite) {
    echo $affiliateSite->ID . $affiliateSite->name . ' (' . $affiliateSite->URL . ') <br />';
}
*/


function postback() {

	global $OrderID;
	global $CampaignID;
	global $Commission;
	global $TotalCost;
	global $RefID;
	global $Currency;
	global $Date;

	return $postback = "https://track.clickwise.net/pb?ActionCode=sale&CampaignID=$CampaignID&RefId=$RefID&OrderId=$OrderID&TotalCost=$TotalCost&Commission=$Commission&Currency=$Currency&Date=$Date";


}

$paises = array ("polonia" => "2d9be911a4cf701bec72005acfea95fb38220d64","españa" => "d37defc2bb8ffae6a1cfdd309b056583e223a5dd");


foreach ($paises as $pais => $codigo) {

	$endDate = date("Y-m-d");
	$startDate = date("Y-m-d", strtotime( "-1 day", strtotime( $endDate ) ) );

	$client = new SoapClient('http://ws.tradetracker.com/soap/affiliate?wsdl', array('compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP));
	$client->authenticate("146342", $codigo);

// Cambiamos el affiliateSiteID dependiendo del pais
	
	if ($codigo == "2d9be911a4cf701bec72005acfea95fb38220d64") {
	 	$affiliateSiteID = 264191;
	 } elseif ($codigo == "d37defc2bb8ffae6a1cfdd309b056583e223a5dd") {
	 	$affiliateSiteID = 271466;
	 }
// Para separar las transacciones de diferentes paises

/*	 echo "<br/>";
	 echo "<br/>";
*/

// Pruebas para comprobar si recogemos los valores

/*
	echo "<br/>";
	echo $pais;
	echo "<br/>"; 
	echo $codigo;
	echo "<br/>";
	echo $affiliateSiteID;
	echo "<br/>";
*/	
// Rango de fecha original, desde el dia anterior hasta el dia de hoy


	$options = array (
	    'registrationDateFrom' => $startDate,
	    'registrationDateTo' => $endDate,
	);

// Rango de fecha manual
/*
	$options = array (
	    'registrationDateFrom' => '2017-03-29',
	    'registrationDateTo' => '2017-03-31',
	);
*/
// Inicializamos un contador para contar transacciones
/*	$contador = 0; */

	foreach ($client->getConversionTransactions($affiliateSiteID, $options) as $transaction) {

//Inicialiamos las variables / Damos valores

		$OrderID = $transaction->ID;
		$CampaignID = $transaction->campaign->name;
		$Commission = $transaction->commission;
		$TotalCost = $transaction->orderAmount;
		$RefID = $transaction->reference;
		$Fecha = $transaction->registrationDate;
		$Date = substr($Fecha, 0,10);
		$Currency;

//para contar las lineas
/*		$contador++; 	*/

		switch ($CampaignID) {
			case 'Lampy.pl':
				$CampaignID = "ec7c3e2c";
				break;
			case 'Astratex.pl':
				$CampaignID = "c3749332";
				break;
			case 'Mango.pl':
				$CampaignID = "3badfeb8";
				break;	
			case 'Ripley.com.pe':
				$CampaignID = "7dbd11c3";
				break;		
		}

		switch ($affiliateSiteID) {
			case '264191':
				$Currency = "PLN";
				break;		
			case '271466':
				$Currency = "EUR";
				break;
		}
		switch ($RefID) {
			case '':
				$RefID = "4f99af95c9ae7";
				break;
		}
	
// Prueba, muestra por pantalla los valores, linea por linea 
/*	 echo $OrderID . ' - ' . $transaction->registrationDate . ' - ' . $CampaignID . ' - ' . $Commission . ' - ' . $transaction->currency . ' - ' . $RefID .'<br />';	*/

// Para separar el numero de linea junto con el ID del afiliado (para comprobar que el currency estabien por ejemplo)
/*	echo $affiliateSiteID . "-" . $contador . "-";	*/

// Mostrar por pantalla para comprobar que esta bien
/*	echo  postback() . "<br/>";		*/

//ejecutar el postback
	$url = postback();
	$s2s = file_get_contents("$url");
	echo $s2s;

	}
}
 
?>