<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function __invoke()
    {

        $data['page_title'] = 'Monitoring';
        $data['monitor'] = true;
        $data['sensors'] = \App\Sensor::orderBy('id', 'asc')->whereSensorStatus(1)->get();

        return view('landing.index', $data);
    }
}
