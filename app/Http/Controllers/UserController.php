<?php

namespace App\Http\Controllers;

use App\Departement as Departements;
use App\User as Users;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('privilege:UsersView', ['only' => 'index']);
        $this->middleware('privilege:UsersCreate', ['only' => 'create']);
        $this->middleware('privilege:UsersEdit', ['only' => 'edit']);
        // $this->middleware('privilege:DepartementsEdit', ['only' => ]);
        $this->middleware('privilege:UsersDelete', ['only' => 'destroy']);
    }

    public function index()
    {
        //
        $data['page_title'] = 'Users Management';
        $data['users'] = Users::orderBy('id', 'desc')->get();
        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Create User';
        $data['departements'] = Departements::all();
        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'departement_id' => ['required'],
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('backend/images/users');
            $image->move($destinationPath, $name);
            $data['avatar'] = $name;
        }

        $data['name'] = $request->input('name');
        $data['username'] = $request->input('username');
        $data['email'] = $request->input('email');
        $data['password'] = bcrypt($request->input('password'));
        $data['departement_id'] = $request->input('departement_id');
        
        Users::create($data);

        return redirect('users')->with(['create' => 'Data saved successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit User';
        $data['departements'] = Departements::all();
        $data['user'] = Users::whereid($id)->first();
        return view('user.edit', $data);
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
        $data_user = Users::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'departement_id' => ['required'],
        ]);

        if ($request->input('password')) {
            $request->validate([
                'password' => ['string', 'min:5'],
            ]);
            $data['password'] = bcrypt($request->input('password'));
        }

        if ($request->hasFile('avatar')) {
            // Check Image
            $request->validate([
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Delete Img
            if ($data_user->avatar) {
                $image_path = public_path('backend/images/users/' . $data_user->avatar); // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            $image = $request->file('avatar');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('backend/images/users');
            $image->move($destinationPath, $name);
            $data['avatar'] = $name;
        }

        $data['username'] = $request->input('username');
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['departement_id'] = $request->input('departement_id');

        // dd($data);
        Users::where('id', $id)->update($data);

        return redirect('users')->with(['update' => 'Data updated successfully!']);
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
            Users::where('id', $id)->delete();
        });

        // redirect('departements')->with(['delete' => 'Data deleted successfully!']);
        Session::flash('delete', 'Data deleted successfully!');
        return response()->json(['status' => '200']);
    }
}
