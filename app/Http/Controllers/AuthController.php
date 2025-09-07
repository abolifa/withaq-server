<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {

        Log::info('Login request data', $request->all());

        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);


        $user = User::where('username', $validated['username'])->first();

        if (!$user) {
            return response()->json(['message' => 'لم يتم العثور علي الحساب'], 404);
        }

        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'كلمة المرور غير صحيحة'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);

    }

    public function me(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}
