<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

class LoginRepository
{
    public function login($email, $password)
    {
        $credentials = ['email' => $email, 'password' => $password];

        return Auth::attempt($credentials);
    }
}
