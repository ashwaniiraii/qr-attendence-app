<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function RegisterUser()
    {
        return view('register');
    }

    public function StoreUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'profile' => 'nullable|image',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password',
        ]);
        // dd($validator);
        if ($validator->fails()) {
            dd($validator->errors());

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $imagePath = null;
        if ($request->hasFile('profile')) {
            $imagePath = $request->file('profile')->store('profiles', 'public');
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'image' => $imagePath,
        ]);

        return redirect()->route('login')->with('success', 'User created successfully.');
    }

    public function LoginPage()
    {
        return view('login');
    }

    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        $userCredentials = $request->only('email', 'password');
        if (Auth::attempt($userCredentials)) {
            if (Auth::user()->is_admin == 1) {
                // return redirect('/')
            } else {
                return redirect()->route('dashboard');
            }
        } else {
            return back()->withErrors('error', 'username and password is incorrect');
        }
    }

    public function dashboard()
    {
        $users = User::all();
        $totalUsers = $users->count();

        return view('layout.dashboard', compact('users', 'totalUsers'));
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();

        return to_route('login');
    }
}
