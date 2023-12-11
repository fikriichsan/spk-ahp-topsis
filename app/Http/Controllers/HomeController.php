<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        return view('welcome', [
            'title' => 'HOME'
        ]);
    }
    public function faq() {
        return view('faq', [
            'title' => 'FAQ'
        ]);
    }
}
