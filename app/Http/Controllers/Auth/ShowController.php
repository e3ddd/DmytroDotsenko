<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function showIndex()
    {
        return view('index');
    }

    public function showLoginArminForm()
    {
        return view('Administration.login');
    }

    public function showAdminPanel()
    {
        return view('Administration.admin-panel');
    }

    public function showTest()
    {
        return view('test');
    }
}

