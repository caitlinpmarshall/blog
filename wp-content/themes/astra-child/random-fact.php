<?php

$curl = curl_init();

curl_setopt_array($curl, [
CURLOPT_URL => "https://random-facts2.p.rapidapi.com/getfact",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => [
"X-RapidAPI-Host: random-facts2.p.rapidapi.com",
"X-RapidAPI-Key: a755806d2fmsh0250e7c55b34862p1efdecjsn84fd8ab47164"
],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
echo $response;
}
