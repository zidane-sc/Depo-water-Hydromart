<?php

namespace App\Http\Controllers;

use App\GlobalSetting;
use File;
use Illuminate\Http\Request;

class GlobalSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('privilege:SocketView', ['only' => 'socket']);
        $this->middleware('privilege:SocketEdit', ['only' => 'updateSocket']);
        $this->middleware('privilege:DatabaseView', ['only' => 'database']);
        $this->middleware('privilege:DatabaseEdit', ['only' => 'updateDatabase']);
    }

    public function socket()
    {
        $data['page_title'] = "Socket Setting";

        $lastData = \App\GlobalSetting::orderBy('id', 'desc')->first();
        $global_setting = (object) array(
            'id' => isset($lastData->id) ? $lastData->id : 0,
            'host_ip' => isset($lastData->host_ip) ? $lastData->host_ip : 'null',
            'websocket_host' => isset($lastData->websocket_host) ? $lastData->websocket_host : 'null',
            'websocket_port' => isset($lastData->websocket_host) ? $lastData->websocket_port : 'null',
            'websocket_pool_interval' => isset($lastData->websocket_pool_interval) ? $lastData->websocket_pool_interval : null,
        );


        $data['global_setting'] = $global_setting;
        $data['host_ip'] = $lastData->host_ip;
        // dd($data['global_setting']);
        return view('settings.socket', $data);
    }

    public function updateSocket(Request $request, $id = 0)
    {
        if ($id == 0) {
            $global_setting = new \App\GlobalSetting;
        } else {
            $global_setting = \App\GlobalSetting::find($id);
        }

        $global_setting->host_ip = $request->host_ip;
        $global_setting->websocket_host = $request->websocket_host;
        $global_setting->websocket_port = $request->websocket_port;
        $global_setting->websocket_pool_interval = $request->websocket_pool_interval;
        $global_setting->save();

        return redirect()->back()->with(['create' => 'Data saved successfully!']);
    }


    public function database()
    {
        $data['page_title'] = "Database Setting";

        $lastData = \App\GlobalSetting::orderBy('id', 'desc')->first();

        $data['id'] = isset($lastData->id) ? $lastData->id : 0;
        $data['db_host'] = isset($lastData->db_host) ? $lastData->db_host : null;
        $data['db_log_interval'] = isset($lastData->db_log_interval) ? $lastData->db_log_interval : null;
        return view('settings.database', $data);
    }

    public function updateDatabase(Request $request, $id = 0)
    {
        if ($id == 0) {
            $global_setting = new \App\GlobalSetting;
        } else {
            $global_setting = \App\GlobalSetting::find($id);
        }

        $global_setting->db_host = $request->db_host;
        $global_setting->db_log_interval = $request->db_log_interval;
        $global_setting->path_backup = $request->path_backup;

        $global_setting->schedule_second = $request->schedule_second;
        $global_setting->schedule_minute = $request->schedule_minute;
        $global_setting->schedule_hour = $request->schedule_hour;
        $global_setting->schedule_day_of_month = $request->schedule_day_of_month;
        $global_setting->schedule_month = $request->schedule_month;
        $global_setting->schedule_day_of_week = $request->schedule_day_of_week;


        $global_setting->save();

        return redirect()->back()->with(['create' => 'Data saved successfully!']);
    }


    public function other()
    {
        $data['page_title'] = "Other Setting";

        $lastData = \App\GlobalSetting::orderBy('id', 'desc')->first();

        $data['id'] = isset($lastData->id) ? $lastData->id : 0;
        $data['reset_histories'] =  \App\ResetTotalizer::orderBy('id', 'desc')->get();
        return view('settings.other', $data);
    }

    public function updateOther(Request $request, $id = 0)
    {
        if ($id == 0) {
            $global_setting = new \App\GlobalSetting;
        } else {
            $global_setting = \App\GlobalSetting::find($id);
        }
        if ($request->hasFile('logo')) {
            // Check Image
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);



            if ($request->hasFile('logo')) {
                // Delete Img
                if ($global_setting->logo) {
                    $image_path = public_path('backend/images/logo/' . $global_setting->logo); // Value is not URL but directory file path
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                $image = $request->file('logo');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('backend/images/logo');
                $image->move($destinationPath, $name);
                $global_setting->logo = $name;
            }
        }
        $global_setting->plant_name = $request->plant_name;
        $global_setting->location = $request->location;


        $global_setting->save();

        return redirect()->back()->with(['create' => 'Data saved successfully!']);
    }
}
