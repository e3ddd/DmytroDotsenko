<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function showApp()
    {
        return view('app');
    }

    public function showLoginArminForm()
    {
        return view('login');
    }

    public function showAdmin()
    {
        return view('admin');
    }
}

