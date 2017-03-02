<?php

include_once 'rakuten/auth.php';
include_once 'rakuten/export.php';

# campaign match
$cJAPAN= array(
  # JAPAN NETWORK
  "2880" => "9d5ea621",
  "41434" => "017eff65",
  "36689" => "e1a2de45",
  "36690" => "f05d491a",
  "40490" => "1460d36e",
  "41264" => "6f51987d",
  "41265" => "ee33abaf",
  "40508" => "1f57776e"
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

export($start_date,$cJAPAN,$obj->access_token);
