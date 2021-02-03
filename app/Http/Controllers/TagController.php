<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Illuminate\Support\Facades\Validator;
use Exception;

class TagController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('privilege:TagCreate', ['only' => 'storeTag']);
        // $this->middleware('privilege:TagEdit', ['only' => 'update']);
        // $this->middleware('privilege:TagDelete', ['only' => 'delete']);
    }

    public function storeTag(Request $request)
    {
        try {
            $dataTag = $request->input();
            $messages = [
                'unique' => ' :attribute already taken.',
            ];

            Validator::extend('without_spaces', function ($attr, $value) {
                return preg_match('/^\S*$/u', $value);
            });
            $validation = Validator::make($dataTag, [
                'tag_name' => ['required', 'string', 'unique:device_controller_tags'],
                'tag_address' => ['required'],
                'tag_data_type'     => ['required'],
            ], $messages);

            $errors = $validation->errors();
            if (count($errors) > 0) {
                throw new Exception($errors->toJson());
            }

            Tag::create($dataTag);
            return response()->json(['status' => '200']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => '403', 'msg' => $th->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $dataTag = $request->input();
            $messages = [
                'unique' => ' :attribute already taken.',
            ];

            Validator::extend('without_spaces', function ($attr, $value) {
                return preg_match('/^\S*$/u', $value);
            });
            $validation = Validator::make($dataTag, [
                'tag_name'          => ['required', 'string', 'unique:device_controller_tags,tag_name,' . $id],
                'tag_address'       => ['required'],
                'tag_data_type'     => ['required'],
            ], $messages);

            $errors = $validation->errors();
            if (count($errors) > 0) {
                throw new Exception($errors->toJson());
            }
            Tag::where('id', $id)->update($dataTag);

            return response()->json(['status' => '200']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => '403', 'msg' => $th->getMessage()]);
        }
    }


    public function delete($id)
    {
        try {
            $device = Tag::where('id', $id)->delete();
            return response()->json(['status' => '200', 'msg' => $device]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => '403', 'msg' => $th->getMessage()]);
        }
    }
}
