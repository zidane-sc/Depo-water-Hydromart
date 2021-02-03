<?php

namespace App\Http\Controllers;

use App\Goiot;
use Illuminate\Http\Request;
use App\Sensor;
use App\Maintenance;

class GoiotController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->except(['active', 'update', 'resetTotalizer', 'summaryTotalizer']);
        $this->middleware('privilege:MaintenanceView', ['only' => 'index']);
    }

    public function index()
    {
        $data['goiot_setting']= Goiot::orderby('id','desc')->first();
        
        $data['page_title'] = 'Goiot Setting';
        $data['sensors'] = Sensor::orderBy('id', 'desc')->with(['device', 'tag'])->get();
        $data['maintenances'] = Maintenance::orderBy('id', 'desc')->with(['sensors'])->get();

        return view('settings.goiot.index', $data);
    }

    
 

    public function store(Request $request)
    {
        $request->validate([
            'host' => ['required'],
            'deviceid' => ['required'],
            'clientid' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'ph_tag' => ['required'],
            'tss_tag' => ['required'],
            'amonia_tag' => ['required'],
            'cod_tag' => ['required'],
            'flowmeter_tag' => ['required'],
        ]);
        $dataGoiot = Goiot::orderby('id', 'desc')->first();

        try {
            $data['host'] = $request->input('host');
            $data['deviceid'] = $request->input('deviceid');
            $data['clientid'] = $request->input('clientid');
            $data['username'] = $request->input('username');
            $data['password'] = $request->input('password');
            $data['ph_tag'] = $request->input('ph_tag');
            $data['tss_tag'] = $request->input('tss_tag');
            $data['amonia_tag'] = $request->input('amonia_tag');
            $data['cod_tag'] = $request->input('cod_tag');
            $data['flowmeter_tag'] = $request->input('flowmeter_tag');
            // $data['user_id'] = Auth::user()->id;
            if ($dataGoiot) {
                Goiot::where('id', $dataGoiot->id)->update($data);
                return redirect('settings/goiot')->with(['update' => 'Data updated successfully!']);
            }else{
                Goiot::create($data);
                return redirect('settings/goiot')->with(['create' => 'Data saved successfully!']);
            }
        } catch (\Throwable $th) {
            return redirect('settings/goiot')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }
   
}
