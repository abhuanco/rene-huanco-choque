<?php
declare(strict_types=1);

namespace App\DTO {

    /**
     * UserRequestDTO Class
     *
     * A Data Transfer Object (DTO) for encapsulating user data in client requests.
     * Typically used for transferring data when creating or updating a user.
     */
    class UserRequestDTO
    {

        /**
         * UserRequestDTO Constructor.
         *
         * Initializes a new instance of the UserRequestDTO with the necessary user attributes.
         *
         * @param string $name The name of the user.
         * @param string $email The email address of the user.
         * @param string $password The plain-text password for the user.
         */
        public function __construct(
            public string $name,
            public string $email,
            public string $password
        )
        {}
    }
}