<?php

namespace App\DTO {

    class UserRequestDTO
    {
        public function __construct(
            public string $name,
            public string $email,
            public string $password
        ){}
    }
}