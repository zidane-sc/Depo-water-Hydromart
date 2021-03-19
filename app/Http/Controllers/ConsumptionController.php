<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsumptionController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Konsumsi';
        $data['date'] = date('Y-m-d');
        $data['month'] = date('Y-m');
        $data['year'] = date('Y');

        return view('consumption.consumption', $data);
    }

    public function consumptionJson(Request $request)
    {
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
            $date_from = date('Y-m-d H:i:s' ,strtotime($datewhere.' 00:00:00'));
            $date_to = date('Y-m-d H:i:s');
            $daterange = 'hour';
        } elseif ($daterange == 'hour') {
            $daterange = 'minute';
        } else {
            $daterange = 'minute';
        }

        $logs = DB::
            table(DB::raw(" (
            SELECT *,
            ROW_NUMBER() OVER (PARTITION BY date_trunc('" . $daterange . "',created_at),device_name ORDER BY created_at asc) AS rn,
       
            MAX(value) OVER (PARTITION BY date_trunc('" . $daterange . "',created_at),device_name ORDER BY id  desc ROWS BETWEEN UNBOUNDED PRECEDING AND UNBOUNDED FOLLOWING) as value_max,
            MIN(value) OVER (PARTITION BY date_trunc('" . $daterange . "',created_at),device_name ORDER BY id  desc ROWS BETWEEN UNBOUNDED PRECEDING AND UNBOUNDED FOLLOWING) as value_min
			FROM log_values where tag_name = 'totalizer' AND created_at BETWEEN '" . $date_from . "' AND '" . $date_to . "') as dm
            "))
            //          LAST_VALUE(energy_kwh_total) OVER (PARTITION BY date_trunc('" . $daterange . "',created_at),device_id ORDER BY id  desc ROWS BETWEEN UNBOUNDED PRECEDING AND UNBOUNDED FOLLOWING) as kwh_exist,
            // LAST_VALUE(energy_kvarh_total) OVER (PARTITION BY date_trunc('" . $daterange . "',created_at),device_id ORDER BY id  desc ROWS BETWEEN UNBOUNDED PRECEDING AND UNBOUNDED FOLLOWING) as kvarh_exist,
            // LAST_VALUE(energy_kvah_total) OVER (PARTITION BY date_trunc('" . $daterange . "',created_at),device_id ORDER BY id  desc ROWS BETWEEN UNBOUNDED PRECEDING AND UNBOUNDED FOLLOWING) as kvah_exist,

            // FIRST_VALUE(voltage_ll_rvg) OVER (PARTITION BY date_trunc('" . $daterange . "',created_at),device_id ORDER BY id   asc) as firstValue,
            // last_value(voltage_ll_rvg) OVER (PARTITION BY date_trunc('" . $daterange . "',created_at),device_id ORDER BY id  asc ROWS BETWEEN UNBOUNDED PRECEDING AND UNBOUNDED FOLLOWING) as lastValue

            ->select(DB::raw("id,device_name,date_trunc('" . $daterange . "',created_at) as created_at,rn,
            value_max,
            value_min,
            (value_max - value_min) as value_total
            "))
            ->where('rn', 1)
            ->where('tag_name', 'totalizer')
            ->whereBetween('created_at', [$date_from, $date_to])
            ->orderBy('created_at', 'asc')
            ->get();

        // --current
        $consumptionTstamp = [];
    
        $value_total = [];
        $value_max = [];
        $value_min = [];
       

        foreach ($logs as $log) {
            if ($daterange == 'year') {
                array_push($consumptionTstamp, date('Y', strtotime($log->created_at)));
            } elseif ($daterange == 'month') {
                array_push($consumptionTstamp, date('Y-m', strtotime($log->created_at)));
            } elseif ($daterange == 'day') {
                array_push($consumptionTstamp, date('Y-m-d', strtotime($log->created_at)));
            } else {
                array_push($consumptionTstamp, date('H:i', strtotime($log->created_at)));
            }

            array_push($value_total, number_format($log->value_total,2,'.',''));
            array_push($value_max, number_format($log->value_max,2,'.','.'));
            array_push($value_min, number_format($log->value_min,2,'.','.'));
        }



       
        $b = array_map(function($i){
            return 
                [
                    'id'=> $i->id, 
                    'device_name'=> $i->device_name,
                    'datetime'=> $i->created_at,
                    'value_min'=> number_format($i->value_min,2,'.',','),
                    'value_max'=> number_format($i->value_max,2,'.',','),
                    'value_total'=> number_format($i->value_total,2,'.',''),
                ];
        }, $logs->toArray());

        $result['consumption']['all'] = $b;
        $result['consumption']['tstamp'] = $consumptionTstamp;
        $result['consumption']['value_total'] = $value_total;
        $result['consumption']['value_max'] = $value_max;
        $result['consumption']['value_min'] = $value_min;

        $result['date'] = $datewhere;
        return $result;
    }
}
