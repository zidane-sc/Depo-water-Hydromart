<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApiController extends Controller
{
   public function __construct()
    {

    }

    public function logs(Request $request)
    {
        $data['page_title'] = 'API Logs';
        $date = date('Y-m-d');
        if ($request->ajax()) {
            $data['api_logs'] = \App\ApiLog::orderBy('created_at', 'desc')->where('created_at', 'like', "%{$request->date}%")->get();
            return $data['api_logs'];
        } else {
            if (!Auth::check()) {
                return redirect('dashboard');
            }
            $data['api_logs'] = \App\ApiLog::orderBy('created_at', 'desc')->where('created_at', 'like', "%{$date}%")->get();
            return view('api.logs', $data);
        }

    }
}
