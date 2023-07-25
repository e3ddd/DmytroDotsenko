<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Services\LoginService;

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
}
