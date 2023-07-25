<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ShowController extends Controller
{
    public function showApp()
    {
        return view('app');
    }
}

