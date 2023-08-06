<?php

namespace App\Http\Controllers;

use App\Models\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'password' => 'required',
                'email' => 'required|unique:users,email',
                'telephone' => 'required',
                'address' => 'required',
                'name' => 'required|unique:users,name'
            ],
            [
                'name.required' => 'name tidak boleh kosong!',
                'name.unique' => 'name telah terdaftar sebelumnya',
                'password.required' => 'password tidak boleh kosong!',
                'email.required' => 'email tidak boleh kosong!',
                'email.unique' => 'email telah terdaftar sebelumnya',
                'address.required' => 'alamat tidak boleh kosong!',
                'telephone.required' => 'nomor telephone tidak boleh kosong!'

            ]
        );
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $validator->errors()
                ]
            );
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'telephone' => $request->telephone,
            'role' => 'user',
            'password' => Hash::make($request->password)
        ]);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Berhasil registrasi'
            ]
        );
    }

    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'email tidak boleh kosong!',
                'password.required' => 'password tidak boleh kosong!'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [   
                    'status' => 'error',
                    'message' => $validator->errors()
                ]
            );
        }
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credential)) {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('authToken')->plainTextToken;
            $user->token = $token;
            $user->token_type = 'Bearer';
            $data = [
                'status' => 'success',
                'message' => 'anda berhasil login!',
                'data' => $user,
            ];
            return response()->json($data);
        } else {
            $pesan = [
                'pesan' => ['Email atau Password salah,silakan periksa kembali']
            ];
            $data = [
                'status' => 'error',
                'message' => ($pesan),
                'data' => NULL,
            ];
            return response()->json($data);
        }
    }

    public function logout()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->tokens()->delete();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'berhasil logout',
                'data' => NULL,
            ]

        );
    }
}
