<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sensor;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
class AlarmController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => 'alarmList', 'alarmSetting']);
        $this->middleware('privilege:AlarmView', ['only' => 'alarmList']);
        $this->middleware('privilege:AlarmSetting', ['only' => 'alarmSetting']);
        // $this->middleware('privilege:AlarmCreate', ['only' => 'store']);
        // $this->middleware('privilege:AlarmEdit', ['only' => 'update']);
        // $this->middleware('privilege:AlarmDelete', ['only' => 'delete']);
    }
    public function alarmList(Request $request)
    {
        $data['page_title'] = 'Alarm List';
        $date = date('Y-m-d');
        if($request->ajax()){
            $data['alarms'] = \App\Alarm::orderBy('id', 'desc')->where('tstamp','like',"%{$request->date}%")->get();
            return $data['alarms'];
        }else{
       
            $data['alarms'] = \App\Alarm::orderBy('id', 'desc')->where('tstamp','like',"%{$date}%")->get();
        }
        
        return view('alarms.alarm-list', $data);
    }
    public function alarmSetting()
    {
        $data['page_title'] = 'Alarm Setting';
        $data['sensors'] = Sensor::orderBy('id', 'desc')->with(['device', 'tag'])->get();
        $data['alarm_settings'] = \App\AlarmSetting::orderBy('id', 'desc')->get();

        return view('alarms.alarm-setting', $data);
    }

    public function store(Request $request)
    {
        try {
            $dataAlarm = $request->input();
            $validation = Validator::make($dataAlarm, [
                'sensor' => ['required', 'string '],
                'formula' => ['required' ],
                'sp'     => ['required' ],
                'text' => ['required'],
            ]);

            $errors = $validation->errors();
            if (count($errors) > 0) {
                throw new Exception($errors->toJson());
            }

            \App\AlarmSetting::create($dataAlarm);
            return response()->json(['status' => '200']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => '403', 'msg' => $th->getMessage()]);
        }
    }

    public function update(Request $request,$id)
    {
        try {
            $dataAlarm = $request->input();
            $validation = Validator::make($dataAlarm, [
                'sensor' => ['required', 'string '],
                'formula' => ['required'],
                'sp'     => ['required'],
                'text' => ['required'],
            ]);
            $errors = $validation->errors();
            if (count($errors) > 0) {
                throw new Exception($errors->toJson());
            }
            \App\AlarmSetting::whereId($id)->update($dataAlarm);
            return response()->json(['status' => '200']);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => '403', 'msg' => $th->getMessage()]);
        }
    }


    public function delete($id)
    {
        try {
            $device = \App\AlarmSetting::find($id)->delete();
            return response()->json(['status' => '200', 'msg' => $device]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => '403', 'msg' => $th->getMessage()]);
        }
    }
}
