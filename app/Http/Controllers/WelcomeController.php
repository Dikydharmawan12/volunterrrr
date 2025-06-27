<?php

namespace App\Http\Controllers;

use App\Models\PengaturanAcara;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanAcara::first();
        return view('welcome', compact('pengaturan'));
    }
} 