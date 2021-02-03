<?php

namespace App\Http\Controllers;

use App\Maintenance;
use App\Sensor;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Throw_;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class MaintenanceController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->except(['active', 'update', 'resetTotalizer', 'summaryTotalizer']);
        $this->middleware('privilege:MaintenanceView', ['only' => 'index']);
    }

    public function index()
    {

        $data['page_title'] = 'Maintenance Setting';
        $data['sensors'] = Sensor::orderBy('id', 'desc')->with(['device', 'tag'])->get();
        $data['maintenances'] = Maintenance::orderBy('id', 'desc')->with(['sensors'])->get();

        return view('settings.maintenance.index', $data);
    }

    public function create()
    {
        $data['page_title'] = "Create Maintenance Value";
        $data['sensors'] = Sensor::orderBy('id', 'desc')->with(['device', 'tag'])->wherenotIn('sensor_name',  function ($query) {
            $query->select(DB::raw('sensor'))
                ->from('maintenance')
                ->whereRaw('maintenance.sensor = sensors.sensor_name');
        })->get();

        return view('settings.maintenance.create', $data);
    }

    public function edit($id)
    {
        $data['page_title'] = "Edit Maintenance Value";
        $data['maintenance'] = Maintenance::find($id);

        return view('settings.maintenance.edit', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'sensor' => ['required', 'unique:maintenance'],
            'value' => ['required'],
            'status' => ['required'],
        ]);


        try {
            $data['sensor'] = $request->input('sensor');
            $data['value'] = $request->input('value');
            $data['status'] = $request->input('status');
            $data['user_id'] = Auth::user()->id;
            Maintenance::create($data);
            return redirect('settings/maintenance')->with(['create' => 'Data saved successfully!']);
        } catch (\Throwable $th) {
            return redirect('settings/maintenance')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }
    public function update(Request $request,$id)
    {

        $request->validate([
            'value' => ['required'],
            'status' => ['required'],
        ]);

        try {
            $data['value'] = $request->input('value');
            $data['status'] = $request->input('status');
            Maintenance::where('id',$id)->update($data);
            return redirect('settings/maintenance')->with(['update' => 'Data updated successfully!']);
        } catch (\Throwable $th) {
            return redirect('settings/maintenance')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            Maintenance::where('id', $id)->delete();
        });
        Session::flash('delete', 'Data deleted successfully!');
        return response()->json(['status' => '200']);
    }
}
