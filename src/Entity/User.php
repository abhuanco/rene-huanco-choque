<?php

namespace App\Entity {

    class User
    {
        private ?int $id;
        private string $name;
        private string $email;
        private string $password;

        public function __construct(?int $id, string $name, string $email)
        {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
        }

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function getEmail(): string
        {
            return $this->email;
        }

        public function getPassword(): string
        {
            return $this->password;
        }

        public function setName(string $name): void
        {
            $this->name = $name;
        }

        public function setEmail(string $email): void
        {
            $this->email = $email;
        }

        public function setPassword(string $password): void
        {
            $this->password = password_hash($password, PASSWORD_BCRYPT);
        }
    }
}