<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index()
    {

        $data['users'] = Users::paginate(5);
        $data['page_title'] = 'Dashboard';
        $data['departements'] = Departements::all();

        return view('dashboard.index', $data);
    }
}
