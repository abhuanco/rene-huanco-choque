<?php

namespace Tests {

    use PHPUnit\Framework\TestCase;
    use App\Repository\UserRepository;
    use App\Entity\User;
    use App\Exception\UserDoesNotExistException;

    class UserTest extends TestCase
    {
        private UserRepository $userRepository;

        protected function setUp(): void
        {
            $this->userRepository = new UserRepository();
        }

        public function testSaveAndFindUser(): void
        {
            $user = new User(1, 'John Doe', 'john@example.com');
            $this->userRepository->save($user);

            $foundUser = $this->userRepository->getById(1);
            $this->assertNotNull($foundUser);
            $this->assertEquals('John Doe', $foundUser->getName());
        }

        public function testUserNotFound(): void
        {
            $this->assertNull($this->userRepository->getById(999));
        }

        public function whenUserIsNotFoundByIdErrorIsThrown(): void
        {
            $this->expectException(UserDoesNotExistException::class);
            $this->userRepository->getByIdOrFail(999);
        }

        public function testGetByIdOrFailReturnsUser(): void
        {
            $user = new User(1, 'John Doe', 'john@example.com');
            $this->userRepository->save($user);

            $foundUser = $this->userRepository->getById(1);
            $this->assertEquals('John Doe', $foundUser->getName());
        }
    }
}