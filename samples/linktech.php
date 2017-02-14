<?php 



$password= "lenovo1234";

$pass = md5("linktech^".$password);



$today = date("Ymd");

$lastMonth = date("Ymd",strtotime("-1 month"));;
$yesterday = date("Ymd",strtotime("-2 day"));;



$url = "http://www.linktech.cn/AC/trans_list.htm?account_id=clickwise1&sign=$pass&syyyymmdd=$yesterday&eyyyymmdd=$today&output_type=json"; 


//echo $url;


$json = file_get_contents($url);

$data = json_decode($json, true);





foreach ($data["order_list"] as $dato) {

   

	   $totalcost=str_replace(",", "", $dato["sales"]);

	   $date = $dato["order_time"];

	   $year=substr($date, 0, 4);

	   $month=substr($date, 4, 2);;

	   $day=substr($date, 6, 2);;

	   $date = $year."-".$month."-".$day;

	   

	

	   switch($dato["merchant_id"]){

		   case "you163":

				$campaignId="3513466f" ;

		   break;

		   

		   case "nikehk":

				$campaignId="0799a56c" ;

		   break;

		   

		   case "qncps":

				$campaignId="92179c97" ;

		   break;

		   

		   case "sephoracps":

				$campaignId="725d3d7b" ;

		   break;

		   

		   case "lifevcroi":

				$campaignId="21ecfdbd" ;

		   break;

		   

		   case "tujia":

				$campaignId="2cf0b33e" ;

		   break;

		   

		   default:$campaignId="nikehk" ;

		   break;

	   }

	   

	   

	   

	   echo file_get_contents("http://track.clickwise.net/pb?TotalCost=$totalcost&OrderId=$dato[trans_id]&Commission=$dato[commission]&CampaignID=$campaignId&RefId=$dato[u_id]&Date=$date&Currency=CNY");

	   

	   //echo "<hr>";

  



}



?>
