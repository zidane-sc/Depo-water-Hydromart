<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sensor;
use App\Tag;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\DB;
class SensorController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth')->except(['active','update', 'resetTotalizer', 'summaryTotalizer']);
        $this->middleware('privilege:SensorView', ['only' => 'index']);
        // $this->middleware('privilege:SensorEdit', ['only' => 'update']);
    }

    public function index()
    {

        $data['page_title'] = 'Sensors Setting';

        $data['sensors'] = Sensor::orderBy('id','desc')->with(['device','tag'])->get();
        $data['tags'] = Tag::orderBy('id','desc')->with(['device'])->get();
            
        return view('settings.sensors.index', $data);
    }


    public function active(){
        $sensors = Sensor::orderBy('id', 'asc')->whereSensorStatus(1)->get();
        return json_encode($sensors);
    }



    public function update(Request $request, $id)
    {
        try {
            $messages = [
                'unique' => ' :attribute already taken.',
            ];
            

            $gateway_id = \App\Tag::find($request->tag_id)->device_controller_id;
            $request->request->add(['gateway_id'=> $gateway_id ]);
            $dataTag = $request->input();
            
            
            $validation = Validator::make($dataTag, [
                'sensor_display'        => ['required'],
                'tag_id'                => ['required'],
                'sensor_status'         => ['required'],
            ], $messages);

            $errors = $validation->errors();
            if (count($errors) > 0) {
                throw new Exception($errors->toJson());
            }
            Sensor::whereId($id)->update($dataTag);

            return response()->json(['status' => '200']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => '403', 'msg' => $th->getMessage()]);
        }
    }


    public function resetTotalizer(Request $request)
    {
        try {
            $last_log = DB::table('logs')->orderBy('id','desc')->take(1)->first();

            if(!$last_log) 
                $last_log   = 0;

            $data['tstamp'] = $last_log->tstamp;
            $data['logs_id'] = $last_log->id;
            $data['value'] = 0;
            \App\ResetTotalizer::create($data);
            return response()->json(['status' => '200', 'msg'=> $last_log ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => '403', 'msg' => $th->getMessage()]);
        }
    }
    public function summaryTotalizer()
    {   
        if (date('Y-m-d H:i:s') < date('Y-m-d 07:00:00') ) {
            $date_from = date('Y-m-d 07:00:00', strtotime("-1 days"));
            $date_to = date('Y-m-d 06:59:59');
        }else{
            $date_from = date('Y-m-d 07:00:00');
            $date_to = date('Y-m-d 06:59:59', strtotime("+1 days"));
        }
        
        try {
            $dataLogs = DB::table('logs')
                ->select(DB::raw("id,flow_meter"))
                ->where("tstamp", ">=", $date_from)
                ->where("tstamp", "<=", $date_to)
                ->get();
            $global_setting = \App\GlobalSetting::orderBy('id', 'desc')->first();
            $data_reset = \App\ResetTotalizer::orderBy('id', 'desc')->take(1)->first();


            if ($data_reset)
                $id_reset = $data_reset->logs_id;
            else
                $id_reset = 0;

            $totalizer = 0;
            foreach ($dataLogs as $dataLog) {

                if ($id_reset == $dataLog->id) {
                    $totalizer = 0;
                }
                $totalizer += ($dataLog->flow_meter / 3600) * $global_setting->db_log_interval;
            }
            $data['totalizer'] = number_format($totalizer, 1, ',', '.');
            return response()->json(['status' => '200', 'msg'=> $data ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => '403', 'msg' => $th->getMessage()]);
        }
    }
}
