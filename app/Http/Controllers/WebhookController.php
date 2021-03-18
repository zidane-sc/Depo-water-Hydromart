<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function WebHook(Request $request)
    {
        $this->CurlNya($request->all());
        if ($request->tag_name == "liter_permenit1") {
            $old_logs = \App\LogValue::latest("created_at")->where("tag_name", "totalizer")->first();
            $today = date("H:i:s");
            $log = new \App\LogValue();
            $log->device_name = $request->device_name;
            $log->tag_name = "totalizer";
            $log->project_id = $request->project_id;
            if ($today == date("H:i:s", strtotime("11:15:00"))) {
                $log->value = 0;
            } else {
                $log->value = ((float)$request->value / 60) + ($old_logs->value ?? 0);
            }
            $this->CurlNya($log);
            $log->save();
        }
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
