<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\UserProvider as UserProviderContract;
use App\Entities\User;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomUserProvider implements UserProviderContract
{

    public function retrieveById($identifier)
    {
        return DB::table('users')->where('id', $identifier)->first();
    }

    public function retrieveByToken($identifier, $token)
    {

        try {

            $user = JWTAuth::toUser($token);
        } catch (\Exception $e) {
            return null;
        }

        return $user;
    }

    public function updateRememberToken(AuthenticatableContract $user, $token)
    {
        // Мы не используем этот метод для JWT аутентификации
    }

    public function retrieveByCredentials(array $credentials)
    {
        // Поиск пользователя по email
        return DB::table('users')->where('email', $credentials['email'])->first();
    }


    public function validateCredentials(AuthenticatableContract $user, array $credentials)
    {

        return password_verify($credentials['password'], $user->password);
    }
}
