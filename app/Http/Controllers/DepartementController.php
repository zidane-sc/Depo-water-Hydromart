<?php

namespace App\Http\Controllers;

use App\Departement as Departements;
use App\DepartementPrivilege as DepartementPrivileges;
use App\Privilege as Privileges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('privilege:DepartementsView', ['only' => 'index']);
        $this->middleware('privilege:DepartementsCreate', ['only' => 'create']);
        $this->middleware('privilege:DepartementsEdit', ['only' => 'edit']);
        // $this->middleware('privilege:DepartementsEdit', ['only' => ]);
        $this->middleware('privilege:DepartementsDelete', ['only' => 'destroy']);
    }

    public function index()
    {

        $data['page_title'] = 'Management Departements';
        $data['departements'] = Departements::paginate(10);
        return view('departement.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['page_title'] = 'Create Departement';
        $data['departements'] = Departements::all();
        $data['privileges'] = Privileges::all();

        return view('departement.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');
        $data['privileges'] = $request->input('privileges');

        $request->validate([
            'name' => 'required|min:2',
            'privileges' => 'required',
        ]);

        DB::transaction(function () use ($data) {
            // Insert Data Departement
            $departement = Departements::create($data);

            // Insert To departement_privileges
            $data_departement_privilege = array();

            for ($i = 0; $i < count($data['privileges']); $i++) {
                $data_push = array(
                    'privilege_id' => $data['privileges'][$i],
                    'departement_id' => $departement['id'],
                );
                array_push($data_departement_privilege, $data_push);
            }


            DepartementPrivileges::insert($data_departement_privilege);
        });
        return redirect('departements')->with(['create' => 'Data saved successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['departement'] = Departements::findOrFail($id);

        $data['privileges'] = $data['departement']->privilege($id)->get();
        return view('departement.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Departement';
        $data['privileges'] = Privileges::all();
        $data['departement'] = Departements::findOrFail($id);
        // dd($departement);
        return view('departement.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');
        $privileges = $request->input('privileges');

        $request->validate([
            'name' => 'required|min:2',
            'privileges' => 'required',
        ]);

        DB::transaction(function () use ($data, $id, $privileges) {

            // Update departememnt and Remove All Departement Privilege
            Departements::where('id', $id)->update($data);
            DepartementPrivileges::where('departement_id', $id)->delete();

            $data_departement_privilege = array();
            for ($i = 0; $i < count($privileges); $i++) {
                $data_push = array(
                    'privilege_id' => $privileges[$i],
                    'departement_id' => $id,
                );
                array_push($data_departement_privilege, $data_push);
            }


            DepartementPrivileges::insert($data_departement_privilege);
        });
        return redirect('departements')->with(['update' => 'Data updated successfully!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $departement = Departements::where('id', $id)->delete();
            $departement_privilege = DepartementPrivileges::where('departement_id', $id)->delete();
        });

        // redirect('departements')->with(['delete' => 'Data deleted successfully!']);
        Session::flash('delete', 'Data deleted successfully!');
        return response()->json(['status' => '200']);

    }
}
