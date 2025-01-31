<?php

namespace Tests {

    use PHPUnit\Framework\Attributes\Test;
    use PHPUnit\Framework\TestCase;
    use App\Entity\User;

    class UserTest extends TestCase
    {
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

        #[Test]
        public function setName(): void
        {
            $user = new User(null, "John Doe", "johndoe@example.com", "Pa$$2w0rd!");
            $newName = "John Doe Colson";

            $user->setName($newName);

            $this->assertEquals($newName, $user->getName());
        }

        #[Test]
        public function setEmail(): void
        {
            $user = new User(null, "John Doe", "johndoe@example.com", "Pa$$2w0rd!");
            $newEmail = "john.doe@example.com";

            $user->setEmail($newEmail);

            $this->assertEquals($newEmail, $user->getEmail());
        }

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