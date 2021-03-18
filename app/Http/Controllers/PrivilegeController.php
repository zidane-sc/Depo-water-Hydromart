<?php

namespace App\Http\Controllers;

use App\Privilege;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PrivilegeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->except(['active', 'update', 'resetTotalizer', 'summaryTotalizer']);
        // $this->middleware('privilege:MaintenanceView', ['only' => 'index']);
    }

    public function index()
    {
        $data['page_title'] = 'Privilege Setting';
        $data['privileges'] = Privilege::orderBy('id', 'desc')->get();

        return view('settings.privilege.index', $data);
    }

    public function create()
    {
        $data['page_title'] = "Create Privilege Value";

        return view('settings.privilege.create', $data);
    }

    public function edit($id)
    {
        $data['page_title'] = "Edit Privilege Value";
        $data['privilege'] = Privilege::find($id);

        return view('settings.privilege.edit', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:privileges,name'],
        ]);


        try {
            $data['name'] = $request->input('name');
            $data['description'] = $request->input('description') ?? "-";
            Privilege::create($data);
            return redirect('settings/privilege')->with(['create' => 'Data saved successfully!']);
        } catch (\Throwable $th) {
            return redirect('settings/privilege')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => ['required', "unique:privileges,name,$id"]
        ]);

        try {
            $data['name'] = $request->input('name');
            $data['description'] = $request->input('description') ?? "-";
            Privilege::where('id',$id)->update($data);
            return redirect('settings/privilege')->with(['update' => 'Data updated successfully!']);
        } catch (\Throwable $th) {
            return redirect('settings/privilege')->with(['danger' => 'Failed ! ' . $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            Privilege::where('id', $id)->delete();
        });
        Session::flash('delete', 'Data deleted successfully!');
        return response()->json(['status' => '200']);
    }
}
