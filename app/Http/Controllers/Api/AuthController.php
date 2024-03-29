<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Validation\ValidationException;
use Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data["password"] = Hash::make($data["password"]);
        $user = User::create($data);
        return response()->json($this->generateUserToken($user));
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::query()->where('email', $data["email"])->first();
        if (!$user || !Hash::check($data["password"], $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials are incorrect'
            ]);
        }
        return response()->json($this->generateUserToken($user));
    }

    public function logout(): JsonResponse
    {
        $user = auth()->user();
        $userTokens = $user->tokens();
        $userTokens->delete();
        return response()->json(["message" => "User has logged out"]);
    }

    private function generateUserToken(User $user): array
    {
        return [
            'token' => $user->createToken('userToken', ["role-$user->role"])->plainTextToken
        ];
    }
}
