<?php
include_once "auth.php";

// Auth Example
$obj = RakutenAuth("Basic MnJBaVBDNlZpN0ZiNXdaUzRuajcwTHlHakVJYTpubVp6TWtudnFIRjlaX3FfYXFfV2dITTBBdThh",array(
  "grant_type" => "password",
  "username" => "HongKongCW",
  "password" => "Clickwise16",
  "scope" => "3330749",
));
var_dump($obj);
