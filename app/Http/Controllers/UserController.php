<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\RankingApplication;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }
}
