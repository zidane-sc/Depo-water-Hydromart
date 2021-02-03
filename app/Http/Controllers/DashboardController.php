<?php

namespace App\Http\Controllers;

use App\Departement as Departements;
use App\User as Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('privilege:Dashboard');
       
    }

    public function __invoke(Request $request)
    {

        // $dataLogs = DB::table('logs')
        //     ->select(DB::raw("id,flow_meter"))
        //     ->where("tstamp", "LIKE", '%' . date('Y-m-d') . '%')
        //     ->get();


        // $data_reset = \App\ResetTotalizer::orderBy('id','desc')->take(1)->first();
        
        
        // if ($data_reset) 
        //     $id_reset = $data_reset->logs_id;
        // else
        //     $id_reset = 0;

        // $totalizer = 0;
        // foreach ($dataLogs as $dataLog) {

        //     if($id_reset == $dataLog->id){
        //         $totalizer = 0;
        //     }
        //     $totalizer += ($dataLog->flow_meter/3600)*60;
        // }
        // $data['totalizer'] = number_format($totalizer,1,',','.');
        
        
        

        
        $data['users'] = Users::paginate(5);
        $data['page_title'] = 'Dashboard';
        $data['departements'] = Departements::all();
        $data['sensors'] = \App\Sensor::orderBy('id','asc')->whereSensorStatus(1)->get();
        return view('dashboard.index', $data);
    }

    
    
}
