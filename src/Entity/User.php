<?php
declare(strict_types=1);

namespace App\Entity {

    /**
     * User Class
     *
     * Represents a user entity with basic information such as ID, name, email, and a hashed password.
     * Provides methods to access and modify user properties, including hashing the password securely.
     */
    class User
    {
        /**
         * @var int|null $id The unique identifier for the user. Null if not yet assigned.
         */
        private ?int $id;

        /**
         * @var string $name The name of the user.
         */
        private string $name;

        /**
         * @var string $email The email address of the user.
         */
        private string $email;

        /**
         * @var string $password The hashed password of the user.
         */
        private string $password;

        /**
         * User Constructor.
         *
         * Initializes a new instance of the User entity, setting its properties.
         * Password is hashed using the `PASSWORD_BCRYPT` algorithm.
         *
         * @param int|null $id The unique identifier for the user. Null for a new user.
         * @param string $name The name of the user.
         * @param string $email The email address of the user.
         * @param string|null $password The plain-text password for the user. Null if no password is provided.
         */
        public function __construct(?int $id, string $name, string $email, string $password = null)
        {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = password_hash($password, PASSWORD_BCRYPT);
        }

        /**
         * Get the user's ID.
         *
         * @return int|null The user's ID, or null if not assigned.
         */
        public function getId(): ?int
        {
            return $this->id;
        }

        /**
         * Get the user's name.
         *
         * @return string The name of the user.
         */
        public function getName(): string
        {
            return $this->name;
        }

        /**
         * Get the user's email.
         *
         * @return string The email address of the user.
         */
        public function getEmail(): string
        {
            return $this->email;
        }

        /**
         * Get the user's hashed password.
         *
         * @return string The hashed password of the user.
         */
        public function getPassword(): string
        {
            return $this->password;
        }

        /**
         * Set the user's name.
         *
         * @param string $name The new name to set for the user.
         */
        public function setName(string $name): void
        {
            $this->name = $name;
        }

        /**
         * Set the user's email.
         *
         * @param string $email The new email to set for the user.
         */
        public function setEmail(string $email): void
        {
            $this->email = $email;
        }

        /**
         * Set the user's password.
         *
         * Hashes the new password before storing it using the `PASSWORD_BCRYPT` algorithm.
         *
         * @param string $password The new plain-text password to set for the user.
         */
        public function setPassword(string $password): void
        {
            $this->password = password_hash($password, PASSWORD_BCRYPT);
        }
    }
}