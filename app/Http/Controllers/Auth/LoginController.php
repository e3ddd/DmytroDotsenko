<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Services\LoginService;
use http\Exception\RuntimeException;

class LoginController extends Controller
{
    public function login(AdminLoginRequest $request)
    {
        /**
         * @var LoginService $loginService
         */
        $loginService = app(LoginService::class);
        if($loginService->login($request->email, $request->password)){
            $request->session()->regenerate();
            return 1;
        }

        throw new \Exception('Admin not found !');
    }

    public function check()
    {
        foreach (session()->all() as $key => $item){
            if(str_contains($key, 'login_web')){
                return true;
            }
        }

        throw new RuntimeException('You didnt sign in !');
    }
}
