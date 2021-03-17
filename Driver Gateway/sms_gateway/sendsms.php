<?php
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://api.nusasms.com/api/v3/sendsms/plain',
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => array(
        'user' => 'ardhir10_api',
        'password' => '4U602tc',
        'SMSText' =>  'SPARING 2009082822 2020-09-01 09:45:22 7.5 10 1203 12392 ',
        'GSM' => '  6282113222883'
    )
));
$resp = curl_exec($curl);
if (!$resp) {
    die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
} else {
    header('Content-type: text/xml'); /*if you want to output to be an xml*/
    echo $resp;
}
curl_close($curl);
