<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;

class UsersApi extends Controller
{
    public function index(Request $request)
    {
        $requestToken = $request->input('token');
        $requestToken = 12345;
        $token = 12345;
        if ($token === $requestToken) {
            $result['data'] = \App\User::with('departement')->orderBy('id', 'desc')->get();
            $result['status'] = 200;
            $result['message'] = 'success';
            $result['your_token'] = $requestToken;
        } else {
            $result['data'] = [''];
            $result['status'] = 401;
            $result['message'] = 'Unauthenticated';
            $result['your_token'] = $requestToken;
        }

        return json_encode($result);
    }
}
