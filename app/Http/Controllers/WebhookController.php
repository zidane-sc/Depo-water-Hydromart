<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function WebHook(Request $request)
    {   
        $this->CurlNya($request->all());
        \App\LogValue::create($request->all());
        return $request->all();
    }

    private function CurlNya($req)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "9090",
            CURLOPT_URL => "http://localhost:9090/depo-air",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($req),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 33a7abf0-c8ef-1213-ab83-4908b870d288"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
}
