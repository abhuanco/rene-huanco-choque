<?php

namespace Tests {

    use PHPUnit\Framework\Attributes\Test;
    use PHPUnit\Framework\TestCase;
    use App\Entity\User;

    /**
     * UserTest Class
     *
     * A PHPUnit test class to ensure that the `User` entity behaves as expected.
     * This class validates:
     * - Proper functioning of the constructor and getter methods.
     * - Correct behavior of the setter methods for updating user properties.
     * - Secure password hashing and verification.
     */
    class UserTest extends TestCase
    {
        /**
         * Test the `User` constructor and its getter methods.
         *
         * Ensures that the `User` object is initialized properly, and all
         * getter methods return the expected values.
         */
        #[Test]
        public function constructorAndGetters(): void
        {
            $id = 1;
            $name = "John Doe";
            $email = "johndoe@example.com";

            $user = new User($id, $name, $email, "Pa$$2w0rd!");

            $this->assertEquals($id, $user->getId());
            $this->assertEquals($name, $user->getName());
            $this->assertEquals($email, $user->getEmail());
        }

        /**
         * Test the `setName` method of the `User` class.
         *
         * Ensures that the user's name can be updated using the `setName` method,
         * and the `getName` method returns the updated value.
         */
        #[Test]
        public function setName(): void
        {
            $user = new User(null, "John Doe", "johndoe@example.com", "Pa$$2w0rd!");
            $newName = "John Doe Colson";

            $user->setName($newName);

            $this->assertEquals($newName, $user->getName());
        }

        /**
         * Test the `setEmail` method of the `User` class.
         *
         * Ensures that the user's email address can be updated using the `setEmail` method,
         * and the `getEmail` method returns the updated value.
         */
        #[Test]
        public function setEmail(): void
        {
            $user = new User(null, "John Doe", "johndoe@example.com", "Pa$$2w0rd!");
            $newEmail = "john.doe@example.com";

            $user->setEmail($newEmail);

            $this->assertEquals($newEmail, $user->getEmail());
        }

        /**
         * Test the `setPassword` and `getPassword` methods of the `User` class.
         *
         * Ensures that:
         * - The user's password is hashed securely when set.
         * - The hashed password does not match the plain-text password.
         * - The `password_verify` function can verify the original plain-text password
         *   against the hashed password.
         */
        #[Test]
        public function setPassword(): void
        {
            $password = "Pa$$2w0rd!";
            $user = new User(null, "John Doe", "johndoe@example.com", $password);

            $hashedPassword = $user->getPassword();

            $this->assertNotEquals($password, $hashedPassword);
            $this->assertTrue(password_verify($password, $hashedPassword));
        }
    }
}