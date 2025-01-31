<?php
declare(strict_types=1);

namespace App\Repository {

    use App\Entity\User;
    use App\Exception\UserDoesNotExistException;

    /**
     * Class UserRepository
     *
     * A repository implementation for managing User entities in memory.
     * Provides methods to save, update, delete, and fetch users,
     * mimicking the behavior of a persistence layer.
     */
    class UserRepository implements IUserRepository
    {
        /**
         * @var array<int, User> $users An array of users stored in memory indexed by their ID.
         */
        private array $users = [];

        /**
         * @var int $nextId The next ID to assign to a new User.
         */
        private int $nextId = 1;

        /**
         * Save a User entity to the repository.
         *
         * If the User does not have an ID (is new), an ID is assigned, and the User is stored.
         * If the User already has an ID, it replaces the one stored with the same ID.
         *
         * @param User $user The user to save.
         */
        public function save(User $user): void
        {
            if ($user->getId() === null) {
                // Assign a new ID to the user if it does not have one
                $user = new User($this->nextId++, $user->getName(), $user->getEmail(), $user->getPassword());
            }
            $this->users[$user->getId()] = $user;
        }

        /**
         * Update an existing User in the repository.
         *
         * Throws an exception if the User does not exist in the repository.
         *
         * @param User $user The user to update.
         * @throws \InvalidArgumentException If the user does not exist in the repository.
         */
        public function update(User $user): void
        {
            $id = $user->getId();
            if (!$id || !isset($this->users[$id])) {
                throw new \InvalidArgumentException("Cannot update non-existent user.");
            }
            $this->users[$id] = $user;
        }

        /**
         * Delete a User from the repository.
         *
         * If the user does not exist, the operation is silently ignored.
         *
         * @param User $user The user to delete.
         */
        public function delete(User $user): void
        {
            unset($this->users[$user->getId()]);
        }

        /**
         * Retrieve a User by their ID.
         *
         * Returns `null` if the user does not exist.
         *
         * @param int $id The ID of the user to retrieve.
         * @return User|null The user with the specified ID or null if not found.
         */
        public function getById(int $id): ?User
        {
            return $this->users[$id] ?? null;
        }

        /**
         * Retrieve a User by their ID, and throw an exception if the user does not exist.
         *
         * @param int $id The ID of the user to retrieve.
         * @return User The user with the specified ID.
         * @throws UserDoesNotExistException If no user is found with the given ID.
         */
        public function getByIdOrFail(int $id): User
        {
            if (!isset($this->users[$id])) {
                throw new UserDoesNotExistException("User with ID $id does not exist.");
            }
            return $this->users[$id];
        }

        /**
         * Retrieve all stored users from the repository.
         *
         * @return User[] An array of all users.
         */
        public function getAll(): array
        {
            return $this->users;
        }
    }
}