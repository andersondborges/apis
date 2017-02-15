<?php

include 'rakuten/auth.php';

## get new token obj
$obj = RakutenAuth("Basic MnJBaVBDNlZpN0ZiNXdaUzRuajcwTHlHakVJYTpubVp6TWtudnFIRjlaX3FfYXFfV2dITTBBdThh",array(
  "grant_type" => "password",
  "username" => "HongKongCW",
  "password" => "Clickwise16",
  "scope" => "3330749",
));

# export commissions
$c = new Curl("https://api.rakutenmarketing.com/events/1.0/transactions",array("Authorization: Bearer ".$obj->access_token));
$c->request("GET");
for($i=0;$i < count($c->obj);$i++){
  // print each transaction
    // TODO do s2s request
    var_dump($c->obj[$i]);
}
