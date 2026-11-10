<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view("login");
    }

    public function registerPage()
    {
        return view("register");
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|email|exists:users,email",
            "password" => "required",
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    "email" => "Email atau password salah.",
                ])
                ->onlyInput("email");
        }

        $request->session()->regenerate();
        $role = Auth::user()->role;
        if ($role == "admin") {
            return redirect()->route("home");
        }

        if ($role == "pemilik") {
            return redirect()->route("home");
        }

        if ($role == "penyewa") {
            return redirect()->route("home");
        }
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            "name" => ["required", "string"],
            "email" => ["required", "email"],
            "password" => ["required"],
            "role" => ["required", "in:pemilik,penyewa"],
            "no_tlpn" => ["required", "digits_between:10,13"],
        ]);

        $validated["password"] = Hash::make($validated["password"]);

        User::create($validated);

        return redirect()->route("login");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("login");
    }
}
