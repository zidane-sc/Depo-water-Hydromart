<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('privilege:ApiView', ['only' => 'apiConfig']);
        $this->middleware('privilege:ApiEdit', ['only' => 'updateApi']);
    }

    public function apiConfig()
    {
        $data['page_title'] = "Api Setting";
        $lastData = \App\ApiSetting::orderBy('id', 'desc')->first();
        $api_setting = (object) array(
            'id' => isset($lastData->id) ? $lastData->id : 0,
            'server_url' => isset($lastData->server_url) ? $lastData->server_url : null,
            'uid' => isset($lastData->uid) ? $lastData->uid : null,
            'jwt_secret' => isset($lastData->jwt_secret) ? $lastData->jwt_secret : null,
            'send_interval' => isset($lastData->send_interval) ? $lastData->send_interval : null,
        );
        $data['api_setting'] = $api_setting;
        return view('settings.api', $data);
    }

    public function updateApi(Request $request, $id = 0)
    {
        if ($id == 0) {
            $api_setting = new \App\ApiSetting;
        } else {
            $api_setting = \App\ApiSetting::find($id);
        }

        $api_setting->server_url = $request->server_url;
        $api_setting->uid = $request->uid;
        $api_setting->jwt_secret = $request->jwt_secret;
        $api_setting->send_interval = $request->send_interval;
       
        $api_setting->save();

        return redirect()->back()->with(['create' => 'Data saved successfully!']);
    }
}
