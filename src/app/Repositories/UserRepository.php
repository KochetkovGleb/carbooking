<?php

namespace App\Repositories;

use App\Entities\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{

    public function save(User $user): void
    {
        DB::insert('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => password_hash($user->password, PASSWORD_BCRYPT), // Хеширование пароля
        ]);
    }
    public function findByEmail(string $email): ?User
    {

        $data = DB::selectOne('SELECT * FROM users WHERE email = :email', ['email' => $email]);

        if (!$data) {
            return null;
        }

        return new User($data->id, $data->name, $data->email, $data->password);
    }
}
