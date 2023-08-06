<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createRegister()
    {
        return view('pages.register');
    }

    public function storeRegister(Request $request)
    {
        // return $request;
        $request->validate(
            [
                'email' => 'required', // 'email' = dari input form 
                'username' => 'required|min:6|unique:users,name',
                'telephone' => 'required|numeric',
                'address' => 'required|min:10|max:100',
                'role' => 'required',
                'password' => 'required|min:8|max:20',
                'confirm_password' => 'required|same:password',
            ],
            [
                'email.required' => 'tidak boleh KOSONG!',
                'username.required' => 'tidak boleh KOSONG!',
                'username.min' => 'username terlalu PENDEK!',
                'username.unique' => 'NAMA username sudah ADA!',
                'telephone.required' => 'tidak boleh KOSONG!',
                'address.required' => 'tidak boleh KOSONG!',
                'address.min' => 'ALAMAT terlalu PENDEK!',
                'address.max' => 'ALAMAT terlalu panjang!',
                'role.reuired' => 'tidak boleh KOSONG!',
                'password.required' => 'tidak boleh KOSONG!',
                'password.min' => 'PASSWORD terlalu PENDEK',
                'password.max' => 'PASSWORD terlalu PANJANG',
                'confirm_password.required' => 'tidak boleh KOSONG!',
                'confirm_password.same' => 'PASSWORD tidak sama!',
            ]
        );

        User::create([
            'name' => $request->username, //'name' dari name yang ada pada tabel database
            'email' => $request->email,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back();
    }

    public function login()
    {
        return view('pages.login');
    }

    public function prosesLogin(Request $request)
    {
        // return $request;
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:8|max:20',
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credential)) {
            return redirect('/dashboard');
        } else {
            return redirect()->back()->with('gagal', 'email atau password tidak sesuai');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
