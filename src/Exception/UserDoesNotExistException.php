<?php

namespace App\Exception {

    use Exception;

    class UserDoesNotExistException extends Exception
    {
        public function __construct($message = "User does not exist", $code = 0, Exception $previous = null)
        {
            parent::__construct($message, $code, $previous);
        }
    }
}