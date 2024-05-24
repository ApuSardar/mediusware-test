<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function index()
    {
        return view('user.index');
    }
    public function loginPage()
    {
        return view('user.login');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5',
            'account_type' => 'required|in:Individual,Business',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'account_type' => $request->account_type,
        ]);

        return back()->with('success', "User Created Successfully");
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;
            return view('user.dashboard');
            // return response()->json(['token' => $token], 200);

        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
