<?php

namespace Tests {

    use App\Entity\User;
    use App\Exception\UserDoesNotExistException;
    use App\Repository\UserRepository;
    use PHPUnit\Framework\TestCase;

    class UserRepositoryTest extends TestCase
    {
        private UserRepository $repository;

        protected function setUp(): void
        {
            $this->repository = new UserRepository();
        }

        public function testSaveAndRetrieveUser(): void
        {
            $user = new User(null, 'John Doe', 'john.doe@example.com');
            $this->repository->save($user);

            $savedUser = $this->repository->getById(1);

            $this->assertNotNull($savedUser);
            $this->assertSame('John Doe', $savedUser->getName());
            $this->assertSame('john.doe@example.com', $savedUser->getEmail());
        }

        public function testUpdateUser(): void
        {
            $user = new User(null, 'Jane Doe', 'jane.doe@example.com');
            $this->repository->save($user);

            $savedUser = $this->repository->getById(1);
            $this->assertSame('Jane Doe', $savedUser->getName());

            // Update the user
            $updatedUser = new User($savedUser->getId(), 'Jane Smith', 'jane.smith@example.com');
            $this->repository->update($updatedUser);

            $retrievedUser = $this->repository->getById(1);
            $this->assertSame('Jane Smith', $retrievedUser->getName());
            $this->assertSame('jane.smith@example.com', $retrievedUser->getEmail());
        }

        public function testDeleteUser(): void
        {
            $user = new User(null, 'John Roe', 'john.roe@example.com', 'Pa$$2w0rd!');
            $this->repository->save($user);

            $this->assertNotNull($this->repository->getById(1));

            $this->repository->delete($user);

            $this->assertNull($this->repository->getById(1));
        }

        public function testGetByIdOrFailUserExists(): void
        {
            $user = new User(null, 'Alice', 'alice@example.com');
            $this->repository->save($user);

            $retrievedUser = $this->repository->getByIdOrFail(1);
            $this->assertSame('Alice', $retrievedUser->getName());
        }

        public function testGetByIdOrFailThrowsException(): void
        {
            $this->expectException(UserDoesNotExistException::class);
            $this->expectExceptionMessage('User with ID 1 does not exist.');

            $this->repository->getByIdOrFail(1);
        }

        public function testGetAll(): void
        {
            $user1 = new User(null, 'User One', 'user1@example.com');
            $user2 = new User(null, 'User Two', 'user2@example.com');

            $this->repository->save($user1);
            $this->repository->save($user2);

            $allUsers = $this->repository->getAll();
            $this->assertCount(2, $allUsers);
            $this->assertArrayHasKey(1, $allUsers);
            $this->assertArrayHasKey(2, $allUsers);
        }
    }
}