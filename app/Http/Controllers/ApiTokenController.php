<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiTokenController extends Controller
{
    public function generateToken(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Пользователь не авторизован'], 401);
        }

        // Удаляем все предыдущие токены пользователя
        $user->tokens()->delete();

        // Создаем новый токен без дополнительных опций
        $token = $user->createToken('personal-access-token');
        return response()->json([
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer',
        ]);
    }
}
