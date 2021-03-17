<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConnectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'alarmList', 'alarmSetting']);
    }

    public function logs(Request $request)
    {
        $data['page_title'] = 'Connection Logs';
        $date = date('Y-m-d');
        if ($request->ajax()) {
            $data['connection_logs'] = \App\ConnectionLog::orderBy('tstamp', 'desc')->where('tstamp', 'like', "%{$request->date}%")->get();
            return $data['connection_logs'];
        } else {
            $data['connection_logs'] = \App\ConnectionLog::orderBy('tstamp', 'desc')->where('tstamp', 'like', "%{$date}%")->get();
        }

        return view('connection.logs', $data);
    }
}
