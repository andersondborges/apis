<?php

$ch = curl_init();

$endDate = date("Y-m-d");
$startDate = date("Y-m-d", strtotime( "-1 day", strtotime( $endDate ) ) );
#$customDate = '2017-03-22';

curl_setopt($ch, CURLOPT_URL,"http://ows.ozon.ru/PartnerStatisticsService/PartnerStatisticsService.asmx/GetPartnerStatisticInformationInterval?partnerName=clickwise_partner&login=anna@clickwise.net&password=Maradona10&dateFrom=$startDate&dateTo=$endDate");

// receive server response...

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// viene en formato XML

$server_output = curl_exec($ch);

//transformando a String

$xml = simplexml_load_string($server_output);

//transformando a Array

$array = json_decode(json_encode($xml),1);

// cerramos curl

curl_close ($ch);

// creamos la funcion del postback

function postback() {

	global $OrderID;
	global $TotalCost;
	global $Commission;
	global $RefId;
	global $Date;

	return $postback = "https://track.clickwise.net/pb?ActionCode=sale&CampaignID=43541891&RefId=$RefId&OrderId=$OrderID&TotalCost=$TotalCost&Commission=$Commission&Date=$Date&Currency=RUB";


}

// contar los registros que tiene el XML

$i = count($array['Stats']['OrderItem']);

// por cada registro existente modificaremos las variables

for ($j = 1; $j < $i; $j++) {

// necesitamos el orderid, totalcost y el refid

$Orderuno = $array['Stats']['OrderItem'][$j]['ItemId'];
$Orderdos = $array['Stats']['OrderItem'][$j]['StatIdent'];
$OrderID = $Orderuno."_".$Orderdos;
$TotalCost = $array['Stats']['OrderItem'][$j]['Price'];
$Commission = $array['Stats']['OrderItem'][$j]['Summ'];
$RefId = $array['Stats']['OrderItem'][$j]['AgentId'];
$Fecha = $array['Stats']['OrderItem'][$j]['Date'];
$Date  = substr($Fecha, 6,4).substr($Fecha, 3,2).substr($Fecha, 0,2);


//Comprobar el numero de callbacks ejecutados
/*
echo $j;
echo "\n";
*/

// Ejecutar http get request
$url = postback();
$s2s = file_get_contents("$url");
echo $s2s;


// Mostrar por pantala
/*	
echo $j;
echo postback();
echo "\n";
*/

}

// Diferentes comandos para comprobar contenidos


#print_r($array['Stats']['OrderItem'][1]['ItemId']);
#print_r($array['Stats']['OrderItem']['1']['ItemId']);
#print_r($xml);
#print_r($array);
#var_dump($array["DateTo"]);
#var_dump($xml["Stats"]["OrderItem"]["ItemId"]["0"]["ItemId"]);
#echo $xml;

?>
