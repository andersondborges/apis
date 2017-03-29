<?php


$ch = curl_init();

$endDate = date("Y-m-d"); 
$startDate = date( "Y-m-d", strtotime( "-1 day", strtotime( $endDate ) ) );
$customDate = '2017-01-24'; 

curl_setopt($ch, CURLOPT_URL,"http://affiliate-feeds.snapdeal.com/feed/api/order?startDate=$startDate&endDate=$endDate&status=approved");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Snapdeal-Affiliate-Id: 71675",
			"Snapdeal-Token-Id: 7d460ed9a611c5030726cdd22d67fe",
			"Accept: application/json"			
			));


// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

$apiResponse = json_decode($server_output, true);

$i = count($apiResponse['productDetails']);


for ($j = 0; $j < $i; $j++) {


$date = date_create($apiResponse['productDetails'][$j]['dateTime']);


$postback = /*file_get_contents(*/'http://track.clickwise.net/pb?ActionCode=sale&CampaignID=108e0b35&RefId=' . $apiResponse['productDetails'][$j]['affiliateSubId1'] . '&OrderId=' . $apiResponse['productDetails'][$j]['orderCode'] . '&TotalCost='  . $apiResponse['productDetails'][$j]['price'] . '&Currency=INR' . '&Date=' . date_format($date, 'Y-m-d') . '&Comission=' . $apiResponse['productDetails'][$j]['commissionEarned'] . "\n"/*)*/;

echo $postback;

}

curl_close ($ch);


?> 
