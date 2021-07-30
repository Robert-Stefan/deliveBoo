<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // ADMIN HOMEPAGE
    public function index()
    {

        $user = Auth::user();

        return view('admin.home', compact('user'));
    }
}