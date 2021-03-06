<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
  public function index()
  {
    return view('auth.register');
  }

  public function store(Request $request)
  {
    // validation
    request()->validate([
      'name' => 'required|max:255',
      'username' => 'required|max:255',
      'email' => 'required|email|max:255',
      'password' => 'required|confirmed'
    ]);
    // Store user
    $user = User::create([
      'name' => $request->name,
      'username' => $request->username,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    
    // sign the user in
    Auth::login($user);
    // redirect user
    return redirect()->route('dashboard');
  }
}
