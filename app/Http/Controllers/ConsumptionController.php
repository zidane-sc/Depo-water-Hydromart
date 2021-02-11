<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsumptionController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Consumption';

        $data['date'] = date('Y-m-d');
        $data['month'] = date('Y-m');
        $data['year'] = date('Y');

        return view('consumption.consumption', $data);
    }
}
