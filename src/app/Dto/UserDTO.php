<?php

namespace App\Dto;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class UserDTO
{
    public ?string $name;
    public ?string $email;
    public ?string $password;

    public function __construct(?string $name, ?string $email, ?string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public static function fromRegisterRequest(UserRequest $request): self
    {
        $data = $request->validated();

        return new self(
            $data['name'],
            $data['email'],
            $data['password'],
        );
    }

    public static function fromLoginRequest(LoginRequest $request): self
    {
        $data = $request->validated();

        return new self(
            null,
            $data['email'],
            $data['password'],
        );
    }
}
