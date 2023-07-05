<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use App\Services\LoginService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
