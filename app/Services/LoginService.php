<?php

namespace App\Services;

use App\Repositories\LoginRepository;

class LoginService
{
    private LoginRepository $loginRepository;

    public function __construct(LoginRepository $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    public function login($email, $password)
    {
        return $this->loginRepository->login($email, $password);
    }
}
