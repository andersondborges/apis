<?php

include 'rakuten/auth.php';

# campaign match
$campaigns = array(
  # JAPAN NETWORK
  "2880" => "9d5ea621",
  "41434" => "017eff65",
  "36689" => "e1a2de45",
  "36690" => "f05d491a"
);

## get new token obj
$obj = RakutenAuth("Basic MnJBaVBDNlZpN0ZiNXdaUzRuajcwTHlHakVJYTpubVp6TWtudnFIRjlaX3FfYXFfV2dITTBBdThh",array(
  "grant_type" => "password",
  "username" => "HongKongCW",
  "password" => "Clickwise16",
  "scope" => "3330749",
));

// TODO improve time managment
$start_date = "2017-02-21%2002:00:00:00";

# export commissions
$c = new Curl("https://api.rakutenmarketing.com/events/1.0/transactions?process_date_start=".$start_date,array("Authorization: Bearer ".$obj->access_token));
$c->request("GET");
for($i=0;$i < count($c->obj);$i++){
    $actualCamp = $campaigns[$c->obj[$i]->advertiser_id];
    $orderid = $c->obj[$i]->order_id;
    $totalCost = $c->obj[$i]->sale_amount;
    $commission = $c->obj[$i]->commissions;
    $refid = $c->obj[$i]->u1;
    $currency = $c->obj[$i]->currency;

    // parse date
    $darr = date_parse($c->obj[$i]->transaction_date);
    $date  = $darr["year"] . "-" . $darr["month"] . "-" . $darr["day"];

	  $url = "http://track.clickwise.net/pb?TotalCost=$totalCost&OrderId=$orderid&Commission=$commission&CampaignID=$actualCamp&RefId=$refid&Date=$date&Currency=$currency";
    echo $url ."\n";
    $s2s = new Curl($url);
    $s2s->request("GET");
    var_dump($s2s->obj);
}
