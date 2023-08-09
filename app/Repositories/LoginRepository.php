<?php

namespace App\Repositories;


use App\Http\CheckNullableInterface;
use App\Http\CheckNullableParams;
use Illuminate\Support\Facades\Auth;
use RuntimeException;

class LoginRepository implements CheckNullableInterface
{
    public function checkNullable(mixed $value, mixed $exceptions = null)
    {
        $check = CheckNullableParams::checkNullable($value);

        if(is_array($value)){
            if($check){
                foreach ($check as $key => $item){
                    if($exceptions !== null){
                        foreach ($exceptions as $exception){
                            if($exception == $key){
                                return;
                            }
                        }
                    }
                    throw new RuntimeException($key . ' is required ! Now is null');
                }
            }
        }else{
            if($check){
                throw new RuntimeException($value . ' is required ! Now is null');
            }
        }
    }

    public function login($email, $password)
    {
        $this->checkNullable(['email' => $email, 'password' => $password]);

        $credentials = ['email' => $email, 'password' => $password];

        return Auth::attempt($credentials);
    }
}
