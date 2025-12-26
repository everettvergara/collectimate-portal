<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class home_controller extends Controller
{
    public function index()
    {
        return view('home.home', []);
    }
}
