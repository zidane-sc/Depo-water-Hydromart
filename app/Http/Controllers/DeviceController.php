<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Device;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['all', 'detail', 'store', 'edit', 'delete', 'update']]);
        $this->middleware('privilege:DeviceView', ['only' => 'index']);
        $this->middleware('privilege:DeviceDetail', ['only' => 'detail']);
        // $this->middleware('privilege:DeviceCreate', ['only' => 'store']);
        // $this->middleware('privilege:DeviceEdit', ['only' => 'edit']);
        // $this->middleware('privilege:DeviceDelete', ['only' => 'delete']);
        // $this->middleware('privilege:DeviceAll', ['only' => 'all']);
    }
    public function index()
    {

        $data['page_title'] = 'Device Setting';
        $data['device'] = Device::orderBy('id', 'desc')->first();

        if (isset($data['device']->id))
            $data['tags'] = Device::find($data['device']->id)->tags()->orderBy('id', 'desc')->get();
        else
            $data['tags'] = [];

        return view('settings.devices.setting', $data);
    }

    public function detail($id)
    {
        $data['page_title'] = 'Device Setting';
        $data['device'] = Device::find($id);

        if ($data['device'] === null)
            return redirect('settings/device');

        $data['tags'] = Device::find($id)->tags()->orderBy('id', 'desc')->get();

        return view('settings.devices.setting', $data);
    }


    public function all()
    {
        try {
            $devices = Device::orderBy('id', 'desc')->get();
            return response()->json(['status' => '200', 'msg' => $devices]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => '403', 'msg' => $th->getMessage()]);
        }
    }

    public function store(Request $request)
    {

        try {
            $dataController = $request->input();
            $messages = [
                'unique' => ' :attribute already taken.',
                'ip' => 'Host must be a valid IP address.',
                'without_spaces' => 'Not allowed to use spaces, Use underscores \'example_id\'',
            ];

            Validator::extend('without_spaces', function ($attr, $value) {
                return preg_match('/^\S*$/u', $value);
            });
            $validation = Validator::make($dataController, [
                'controller_name' => ['required', 'string', 'min:4', 'unique:device_controllers'],
                'controller_host' => ['required', 'ip'],
                'controller_port'     => ['required', 'min:3', 'max:10'],
                'controller_device_id' => ['required', 'without_spaces', 'string'],
            ], $messages);

            $errors = $validation->errors();
            if (count($errors) > 0) {
                throw new Exception($errors->toJson());
            }

            Device::create($dataController);
            return response()->json(['status' => '200']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => '403', 'msg' => $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $device = Device::findOrFail($id);
            return response()->json(['status' => '200', 'msg' => $device]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => '403', 'msg' => $th->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $dataController = $request->input();
            $messages = [
                'unique' => ' :attribute already taken.',
                'ip' => 'Host must be a valid IP address.',
                'without_spaces' => 'Not allowed to use spaces, Use underscores \'example_id\'',
            ];

            Validator::extend('without_spaces', function ($attr, $value) {
                return preg_match('/^\S*$/u', $value);
            });
            $validation = Validator::make($dataController, [
                'controller_name' => ['required', 'string', 'min:4', 'unique:device_controllers,controller_name,' . $id],
                'controller_host' => ['required', 'ip'],
                'controller_port'     => ['required', 'min:3', 'max:10'],
                'controller_device_id' => ['required', 'without_spaces', 'string'],
            ], $messages);

            $errors = $validation->errors();
            if (count($errors) > 0) {
                throw new Exception($errors->toJson());
            }

            Device::where('id', $id)->update($dataController);
            return response()->json(['status' => '200']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => '403', 'msg' => $th->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            $device = Device::find($id)->delete();
            return response()->json(['status' => '200', 'msg' => $device]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => '403', 'msg' => $th->getMessage()]);
        }
    }


    // LOGGER NEED
    public function active()
    {
    }
}
