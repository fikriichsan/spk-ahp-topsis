<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view('register', [
            'title' => 'register'
        ]);
    }
    public function store(Request $request) {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:15',            
        ]);
        $validateData['is_admin'] = 0;
        User::create($validateData);
        return redirect('/login')->with('success', 'Registration successfull! Please login');
    }
}
