<?php

$url = "https://olx.plc-department.space/olx_parse1";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

$response = curl_exec($ch);


var_dump($response);
