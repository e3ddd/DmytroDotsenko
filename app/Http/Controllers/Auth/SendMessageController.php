<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMessageController extends Controller
{
    public function send(Request $request)
    {
        if($request->lang == 'ua'){
            $painting = [
                'name' => $request->painting['name_ua'],
                'price' => $request->painting['price'],
            ];
        }

        try {
            Mail::to($request->email)->send(new OrderMail($painting, $request->email));
        }catch (\RuntimeException $exception){
            throw new $exception;
        }
    }
}
