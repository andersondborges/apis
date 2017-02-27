<?php

function export($start_date,$campaigns,$bear){
  # export commissions
  $c = new Curl("https://api.rakutenmarketing.com/events/1.0/transactions?process_date_start=".$start_date,array("Authorization: Bearer ".$bear));
  $c->request("GET");
  for($i=0;$i < count($c->obj);$i++){
      $actualCamp = $campaigns[$c->obj[$i]->advertiser_id];
      $orderid = $c->obj[$i]->order_id;
      $totalCost = $c->obj[$i]->sale_amount;
      $commission = $c->obj[$i]->commissions;
      $currency = $c->obj[$i]->currency;

      $affdata = explode("_",$c->obj[$i]->u1);

      // parse date
      $darr = date_parse($c->obj[$i]->transaction_date);
      $date  = $darr["year"] . "-" . $darr["month"] . "-" . $darr["day"];

      if (count($affdata) == 2) {
        $url = "http://track.clickwise.net/pb?TotalCost=$totalCost&OrderId=$orderid&Commission=$commission&CampaignID=$actualCamp&RefId=$affdata[0]&Date=$date&Currency=$currency&ExtraData=$affdata[1]";
      }else{
        $url = "http://track.clickwise.net/pb?TotalCost=$totalCost&OrderId=$orderid&Commission=$commission&CampaignID=$actualCamp&RefId=$affdata[0]&Date=$date&Currency=$currency";
      }

      echo $url ."\n";
      $s2s = new Curl($url);
      $s2s->request("GET");
  }
}
