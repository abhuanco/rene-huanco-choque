<?php
declare(strict_types=1);

namespace Tests {

    use App\Entity\User;
    use App\Exception\UserDoesNotExistException;
    use App\Repository\UserRepository;
    use PHPUnit\Framework\Attributes\Test;
    use PHPUnit\Framework\TestCase;

    /**
     * UserRepositoryTest Class
     *
     * A PHPUnit test class to test the behavior of the `UserRepository` implementation.
     * It ensures that the repository correctly handles:
     * - Saving and retrieving users.
     * - Updating an existing user.
     * - Deleting a user.
     * - Throwing exceptions when accessing non-existent users.
     * - Retrieving all users in the repository.
     */
    class UserRepositoryTest extends TestCase
    {

        /**
         * Test the `save` and `getById` methods of the `UserRepository`.
         *
         * Ensures that a user can be saved to the repository and then retrieved by its ID.
         */
        #[Test]
        public function saveAndRetrieveUser(): void
        {
            $repository = new UserRepository();
            $user = new User(null, 'John Doe', 'john.doe@example.com', "Pa$$2w0rd!");
            $repository->save($user);

            $savedUser = $repository->getById(1);

            $this->assertNotNull($savedUser);
            $this->assertSame('John Doe', $savedUser->getName());
            $this->assertSame('john.doe@example.com', $savedUser->getEmail());
        }

        /**
         * Test the `update` method of the `UserRepository`.
         *
         * Ensures that a user's details can be updated and that the updated details
         * persist in the repository.
         */
        #[Test]
        public function updateUser(): void
        {
            $repository = new UserRepository();
            $user = new User(null, 'Jane Doe', 'jane.doe@example.com', "Pa$$2w0rd!");
            $repository->save($user);

            $savedUser = $repository->getById(1);
            $this->assertSame('Jane Doe', $savedUser->getName());

            // Update the user
            $updatedUser = new User($savedUser->getId(), 'Jane Smith', 'jane.smith@example.com', "Pa$$2w0rd!");
            $repository->update($updatedUser);

            $retrievedUser = $repository->getById(1);
            $this->assertSame('Jane Smith', $retrievedUser->getName());
            $this->assertSame('jane.smith@example.com', $retrievedUser->getEmail());
        }

        /**
         * Test the `delete` method of the `UserRepository`.
         *
         * Ensures that a user can be deleted from the repository and that attempting to retrieve it afterward returns `null`.
         */
        public function testDeleteUser(): void
        {
            $repository = new UserRepository();
            $user = new User(null, 'John Roe', 'john.roe@example.com', 'Pa$$2w0rd!');
            $repository->save($user);

            $user = $repository->getById(1);
            $this->assertNotNull($user);

            $repository->delete($user);

            $this->assertNull($repository->getById(1));
        }

        /**
         * Test the `getByIdOrFail` method of the `UserRepository` for an existing user.
         *
         * Ensures that the method retrieves an existing user without throwing an exception.
         */
        public function testGetByIdOrFailUserExists(): void
        {
            $repository = new UserRepository();
            $user = new User(null, 'Alice', 'alice@example.com', "Pa$$2w0rd!");
            $repository->save($user);

            $retrievedUser = $repository->getByIdOrFail(1);
            $this->assertSame('Alice', $retrievedUser->getName());
        }

        /**
         * Test the `getByIdOrFail` method of the `UserRepository` for a non-existent user.
         *
         * Ensures that the method throws a `UserDoesNotExistException` when trying to retrieve a user that does not exist.
         */
        public function testGetByIdOrFailThrowsException(): void
        {
            $repository = new UserRepository();
            $this->expectException(UserDoesNotExistException::class);
            $this->expectExceptionMessage('User with ID 1 does not exist.');

            $repository->getByIdOrFail(1);
        }

        /**
         * Test the `getAll` method of the `UserRepository`.
         *
         * Ensures that all users saved in the repository are retrieved as expected.
         */
        public function testGetAll(): void
        {
            $repository = new UserRepository();
            $user1 = new User(null, 'User One', 'user1@example.com', "Pa$$2w0rd!");
            $user2 = new User(null, 'User Two', 'user2@example.com', "Pa$$3w0rd!");

            $repository->save($user1);
            $repository->save($user2);

            $allUsers = $repository->getAll();
            $this->assertCount(2, $allUsers);
            $this->assertArrayHasKey(1, $allUsers);
            $this->assertArrayHasKey(2, $allUsers);
        }
    }
}