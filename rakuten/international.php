<?php

include_once 'rakuten/auth.php';
include_once 'rakuten/export.php';

# campaign match
$cinter= array(
  "41264" => "6f51987d",
  "41610" => "0a917bfe",
  "38606" => "682b20b3",
  "40224" => "aacf7ce4",
  "37981" => "f65a35bc",
  "40490" => "1460d36e",
  "41264" => "6f51987d",
  "41265" => "ee33abaf",
  "40508" => "1f57776e"
);

## get new token obj
$obj = RakutenAuth("Basic N1Q1cUNvSEVUSXRMSWhOOTJSOVN3WGFKblY4YTp5cmtBbFJyM19abnA4UXR2SGdmSGV4RkdFaVlh",array(
  "grant_type" => "password",
  "username" => "clickwisehk",
  "password" => "Maradona10",
  "scope" => "3352396",
));

// TODO improve time managment
$start_date = "2017-02-23%2002:00:00:00";

export($start_date,$cinter,$obj->access_token);
