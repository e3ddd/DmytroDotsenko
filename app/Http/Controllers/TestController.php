<?php

namespace App\Http\Controllers;

use App\Http\CheckNullableParams;
use App\Http\Controllers\Auth\PaintingController;
use App\Mail\OrderMail;
use App\Models\Category;
use App\Models\Painting;
use App\Models\User;
use App\Repositories\PaintingRepository;
use App\Services\PaintingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Jorenvh\Share\Share;

class TestController extends Controller
{
    public function test()
    {
        $category = Category::where('id', [1,4,5,9]);

        dump($category);


    }
}
