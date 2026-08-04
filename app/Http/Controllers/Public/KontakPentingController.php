<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\KontakPenting;

class KontakPentingController extends Controller
{
    public function index()
    {
        $kontaks = KontakPenting::all()->groupBy('kategori');

        return view('public.kontak', compact('kontaks'));
    }
}
