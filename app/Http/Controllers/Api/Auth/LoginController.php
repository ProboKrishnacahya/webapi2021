<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Client;

class LoginController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = Client::find(2);
    }

    public function login(Request $request)
    {
        $user = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'admin',
            'is_login' => '0',
            'is_active' => '1'
        ];

        $check = DB::table('users')->where('email', $request->email)->first();

        if ($check->is_active == '1') {
            if ($check->is_active == '0') {
                if (Auth::attempt($user)) {
                    $this->isLogin(Auth::id());
                } else {
                    return response([
                        'message' => 'Login Failed'
                    ]);
                }
            } else {
                return response([
                    'message' => 'Account is used'
                ]);
            }
        } else {
            return response([
                'message' => 'Account is suspended'
            ]);
        }
    }

    private function isLogin(int $id)
    {
    }
}
