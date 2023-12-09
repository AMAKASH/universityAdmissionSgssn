<?php

namespace App\Http\Controllers;

use App\Models\Scholership;
use Illuminate\Http\Request;
use App\Models\University;

class BaseController extends Controller
{
    public function index()
    {

        $top_universities = University::all();
        $scholerships = Scholership::limit(4)->get();

        return view('landing', [
            'top_universities' => $top_universities,
            'scholerships' => $scholerships
        ]);
    }
}
