<?php

include_once "libs/Curl.php";

function RakutenAuth($authToken,$data = array()){
  $r = new Curl("https://api.rakutenmarketing.com/token",array("Authorization: ".$authToken));
  $r->request("POST-PAYLOAD",$data);
  return $r->obj;
}
