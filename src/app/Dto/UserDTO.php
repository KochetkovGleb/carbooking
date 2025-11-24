<?php

namespace App\Dto;

use Illuminate\Http\Request;

class UserDTO
{
    public ?string $name;  // Необязательное поле
    public ?string $email; // Необязательное поле
    public ?string $password; // Необязательное поле

    // Конструктор для создания объекта UserDTO
    public function __construct(?string $name, ?string $email, ?string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    // Метод для создания объекта UserDTO из данных запроса
    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('name', null),  // Если name не передано, будет null
            $request->input('email', null),  // Если email не передан, будет null
            $request->input('password', null) // Если password не передан, будет null
        );
    }
}
