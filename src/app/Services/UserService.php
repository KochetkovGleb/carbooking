<?php

namespace App\Services;

use App\Dto\UserDTO;
use App\Repositories\UserRepository;
use App\Entities\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(UserDTO $userDTO): User
    {
        // Создаём объект User из DTO
        $user = new User(
            0, // id будет сгенерирован в базе данных
            $userDTO->name,
            $userDTO->email,
            $userDTO->password
        );

        // Сохраняем пользователя в базе данных через репозиторий
        $this->userRepository->save($user);

        return $user;
    }

    public function authenticate(UserDTO $userDTO)
    {

        $user = $this->userRepository->findByEmail($userDTO->email);

        if (!$user || !password_verify($userDTO->password, $user->password)) {
            throw new \Exception('Invalid credentials');
        }

        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            throw new \Exception('Could not create token');
        }

        return $token;
    }
}
