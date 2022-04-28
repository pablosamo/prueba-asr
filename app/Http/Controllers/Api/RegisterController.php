<?php

namespace App\Http\Controllers\Api;

use Hash;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class RegisterController extends Controller
{
    public function store(UserRequest $request)
    {
        User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password)
        ]);

        return response()->json(['message' => 'Usuario creado correctamente']);
    }
}
