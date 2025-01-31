<?php

namespace App\Exception {

    use Exception;
    use Throwable;

    /**
     * UserDoesNotExistException Class
     *
     * This exception is thrown when an operation attempts to access a user
     * that does not exist in the repository or database.
     */
    class UserDoesNotExistException extends Exception
    {
        /**
         * UserDoesNotExistException Constructor.
         *
         * Initializes the exception with a custom message, code, and optionally a previous exception.
         *
         * @param string $message The exception message (default is an empty string).
         * @param int $code The exception code (default is 0).
         * @param Throwable|null $previous Optional previous exception for exception chaining.
         */
        public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
        {
            parent::__construct($message, $code, $previous);
        }
    }
}