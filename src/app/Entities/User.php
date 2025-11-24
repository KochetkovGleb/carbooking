<?php

namespace App\Entities;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User implements JWTSubject
{
    public int $id;
    public string $name;
    public string $email;
    public string $password;

    public function __construct(int $id, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getJWTIdentifier(): string
    {
        return (string) $this->id;
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
