<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $user = Auth::guard('administrator')->user();
        echo 'Xin chào Admin, '. $user->name;
    }
}
