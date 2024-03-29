<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data["password"] = Hash::make($data["password"]);
        $user = User::create($data);
        return $this->generateUserToken($user);
    }

    public function login(LoginRequest $request): array
    {
        $data = $request->validated();
        $user = User::query()->where('email', $data["email"])->first();
        if (!$user || !Hash::check($data["password"], $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials are incorrect'
            ]);
        }
        return $this->generateUserToken($user);
    }

    private function generateUserToken(User $user)
    {
        return [
            'token' => $user->createToken('userToken', ["role-$user->role"])->plainTextToken
        ];
    }
}
