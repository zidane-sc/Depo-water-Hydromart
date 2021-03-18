<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\AlarmSetting;
use Exception;
use Illuminate\Http\Request;
use Throwable;
use DateTime;
use Illuminate\Support\Facades\DB;

class TrendingReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('trend');
        $this->middleware('privilege:TrendingReportView', ['only' => 'index']);
    }


    public function index()
    {
        $data['page_title'] = 'Trending Report';
        $data['tags'] = [
            ['tag_name' => 'ultrasonic_sensor11', 'display_name' => 'Tank1'],
            ['tag_name' => 'ultrasonic_sensor12', 'display_name' => 'Tank2'],
            ['tag_name' => 'liter_permenit1', 'display_name' => 'FLOW RATE'],
            ['tag_name' => 'totalizer', 'display_name' => 'TOTALIZER'],
        ];
        $data['date'] = date('Y-m-d ');
        $dateSelect = date('Y-m');
        // dd($dateSelect . date('-d'));

        $dateSelectBefore = new DateTime($dateSelect . ' 07:00:00');
        $dateSelectAfter = new DateTime($dateSelect . ' 06:59:59');
        $datebefore = $dateSelectBefore->modify('-1 days')->format('Y-m-d H:i:s');
        $dateafter  = $dateSelectAfter->modify('+1 days')->format('Y-m-d H:i:s');
        // dd($datebefore.' '.$dateafter);
        return view('trending-report.index', $data);
    }

    public function trend(Request $request)
    {
        $global_setting = \App\GlobalSetting::orderBy('id', 'desc')->first();
        $daterange = $request->daterange;
        $datewhere = $request->date;

   
        if ($daterange == 'year') {
        
            $date_from = date('Y-01-01 00:00:00',strtotime($datewhere));
            $date_to = date('Y-m-d H:i:s');
            $daterange = 'month';
        
        } elseif ($daterange == 'month') {
        
            $date_from = date('Y-m-01 00:00:00',strtotime($datewhere));
            $date_to = date('Y-m-d H:i:s');
            $daterange = 'day';
        
        } elseif ($daterange == 'day') {
        
        	if($request->tag == 'totalizer'){
         		
            	$dateSelect = ($request->date);
		        $dateSelectBefore = new DateTime($dateSelect . ' 00:00:00');
        		$dateSelectAfter = new DateTime($dateSelect . ' 23:59:59');
        		$date_from = $dateSelectBefore->format('Y-m-d H:i:s');
      			$date_to  = $dateSelectAfter->format('Y-m-d H:i:s');
            	$daterange = 'hour';
            
            }else{
            
            	$date_from = date('Y-m-d H:i:s' ,strtotime($datewhere.' 00:00:00'));
            	$date_to = date('Y-m-d H:i:s');
            	$daterange = 'hour';
            
            }
        
        } elseif ($daterange == 'hour') {
        
            $daterange = 'minute';
        
        } else {
        
            $daterange = 'minute';
        
        }

        if ($request->daterange === 'day') {
        
            $dataLogs = DB::table('log_values')
                ->select(DB::raw("
            date_trunc('" . $daterange . "',created_at) as datetime,
            tag_name,
            avg(value)
            "))
                ->where("tag_name", $request->tag)
                ->whereBetween('created_at', [$date_from, $date_to])
                ->groupBy('datetime', 'tag_name')
                ->orderBy('datetime', 'asc')
                ->get();
        
        } else {
        
            $dataLogs = DB::table('log_values')
                ->select(DB::raw("
            date_trunc('" . $daterange . "',created_at) AS datetime ,
            tag_name,
            avg(value)
            "))
            ->where("tag_name", $request->tag)
                ->whereBetween('created_at', [$date_from, $date_to])
                ->groupBy('datetime', 'tag_name')
                ->orderBy('datetime', 'asc')
                ->get();
        
        }

        $stackTstamp = [];
        $value = [];
        // $stack_avg_tss = [];
        // $stack_avg_amonia = [];
        // $stack_avg_cod = [];
        // $stack_avg_flow_meter = [];

        foreach ($dataLogs as $log) {
            if ($daterange == 'year') {
                array_push($stackTstamp, date('Y', strtotime($log->datetime)));
            } elseif ($daterange == 'month') {
                array_push($stackTstamp, date('Y-m-d', strtotime($log->datetime)));
            } elseif ($daterange == 'day') {
                array_push($stackTstamp, date('Y-m-d', strtotime($log->datetime)));
            } else {
                array_push($stackTstamp, date('Y-m-d H:i:s', strtotime($log->datetime)));
            }
            array_push($value, ($log->avg === 'NaN' || $log->avg === null) ? "0" : number_format((float)$log->avg, 2, '.', ''));
            // array_push($stack_avg_tss, ($log->avg_tss === 'NaN' || $log->avg_tss === null) ? "0" : number_format((float)$log->avg_tss, 2, '.', ''));
            // array_push($stack_avg_amonia, ($log->avg_amonia === 'NaN' || $log->avg_amonia === null) ? "0" : number_format((float)$log->avg_amonia, 2, '.', ''));
            // array_push($stack_avg_cod, ($log->avg_cod === 'NaN' || $log->avg_cod === null) ? "0" : number_format((float)$log->avg_cod, 2, '.', ''));
            // array_push($stack_avg_flow_meter, ($log->avg_flow_meter === 'NaN' || $log->avg_flow_meter === null) ? "0" : number_format((float)$log->avg_flow_meter, 2, '.', ''));
        }
    
		



        // $dataTotalizers = DB::table('logs')
        //     ->select(DB::raw("
        //             date_trunc('day',tstamp) AS datetime ,
        //             max((flow_meter/3600)*" . $global_setting->db_log_interval . ") as totalizer
        //     "))
        //     ->where("tstamp", ">=", $date_from)
        //     ->where("tstamp", "<=", $date_to)
        //     ->groupBy('datetime')
        //     ->orderBy('datetime', 'asc')
        //     ->get();
        $tstamp_totalizer = [];
        $stack_totalizer = [];
        // dicomment dulu untuk totalizer harian satu bar
        // if ($daterange == 'hour' || $daterange == 'day') {
        //     $dataLogs = DB::table('logs')
        //         ->select(DB::raw("id,flow_meter"))
        //         ->where("tstamp", ">=", $date_from)
        //         ->where("tstamp", "<=", $date_to)
        //         ->get();
        //     $global_setting = \App\GlobalSetting::orderBy('id', 'desc')->first();
        //     $data_reset = \App\ResetTotalizer::orderBy('id', 'desc')->take(1)->first();

        //     if ($data_reset)
        //         $id_reset = $data_reset->logs_id;
        //     else
        //         $id_reset = 0;

        //     $totalizer = 0;
        //     foreach ($dataLogs as $dataLog) {

        //         if ($id_reset == $dataLog->id) {
        //             $totalizer = 0;
        //         }
        //         $totalizer += ($dataLog->flow_meter / 3600) * $global_setting->db_log_interval;
        //     }
        //     $totalizer = number_format($totalizer, 0, '.', '');
        //     array_push($tstamp_totalizer, $date_from . ' - ' . $date_to);
        //     array_push($stack_totalizer, ($totalizer === 'NaN' || $totalizer === null) ? "0" : $totalizer);
        // }

        // for ($i=0; $i < 24; $i++) {
        //     $ttlzr = $this->sumTotalizerHour($date_from, $date_to);
        //     array_push($tstamp_totalizer, $dateSelect);
        //     array_push($stack_totalizer, ($ttlzr === 'NaN' || $ttlzr === null) ? "0" : $ttlzr);
        // }



        // echo date("H:00", mktime($time + 1)) . '<br>';

        // foreach ($time as $value) {
        //     if ($value == '00' || $value == '01' || $value == '02' || $value == '03' || $value == '04' || $value == '05' || $value == '06') {
        //         array_push($tstamp_totalizer, $dateafterTotalizer . ' ' . $value . ':00');
        //         $ttlzr = $this->sumTotalizerHour($dateafterTotalizer . ' ' . $value . ':00:00', $dateafterTotalizer . ' ' . $value . ':59:59');
        //     } else {
        //         array_push($tstamp_totalizer, $dateSelect . ' ' . $value . ':00');
        //         $ttlzr = $this->sumTotalizerHour($dateSelect . ' ' . $value . ':00:00', $dateSelect . ' ' . $value . ':59:59');
        //     }



        //     array_push($stack_totalizer, ($ttlzr === 'NaN' || $ttlzr === null) ? "0" : $ttlzr);
        // }


        // $stack_totalizer = array_map(
        //     function ($v) {
        //         if ($v === 0) {
        //             return null;
        //         }
        //         return $v;
        //     },
        //     $stack_totalizer
        // );


        // if ($daterange == 'hour') {
        //     $result['sensors']['totalizer'] = $stack_totalizer;
        //     $result['sensors']['totalizer_tstamp']['tstamp'] = $tstamp_totalizer;
        // } else {
        //     $totalizerMonthly = [];
        //     foreach ($stackTstamp as $ts) {
        //         array_push($totalizerMonthly, $this->sumTotalizer($ts));
        //     }
        //     $result['sensors']['totalizer'] = $totalizerMonthly;
        //     $result['sensors']['totalizer_tstamp']['tstamp'] = $stackTstamp;
        // }


        // data passsing to view
        $result['tstamp'] = $stackTstamp;
        $result['tag_name'] = $request->tag;
        $result['value'] = $value;
        // $result['sensors']['tss'] = $stack_avg_tss;
        // $result['sensors']['amonia'] = $stack_avg_amonia;
        // $result['sensors']['cod'] = $stack_avg_cod;
        // $result['sensors']['flow_meter'] = $stack_avg_flow_meter;
        // alarm setting
        // $result['alarms'] = AlarmSetting::all();
        $result['daterange'] = $dataLogs;

        return json_encode($result);
    }

    private function sumTotalizerHour($date_from, $date_to)
    {
        $dataLogs = DB::table('logs')
            ->select(DB::raw("id,flow_meter"))
            ->where("tstamp", ">=", $date_from)
            ->where("tstamp", "<=", $date_to)
            ->get();
        $global_setting = \App\GlobalSetting::orderBy('id', 'desc')->first();

        $totalizer = 0;
        foreach ($dataLogs as $dataLog) {
            $totalizer += ($dataLog->flow_meter / 3600) * $global_setting->db_log_interval;
        }
        return $totalizer;
    }


    private function sum($a,  $b): int
    {
        return $a + $b;
    }

    private function sumTotalizer($dateSelect)
    {
        $dateSelectBefore = new DateTime($dateSelect . ' 07:00:00');
        $dateSelectAfter = new DateTime($dateSelect . ' 06:59:59');
        $datebefore = $dateSelectBefore->modify('-1 days')->format('Y-m-d H:i:s');
        $dateafter  = $dateSelectAfter->modify('+1 days')->format('Y-m-d H:i:s');



        $date_from = $datebefore;
        $date_to = $dateafter;


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
        $totalizer = number_format($totalizer, 0, '.', '');
        return $totalizer;
    }
}
