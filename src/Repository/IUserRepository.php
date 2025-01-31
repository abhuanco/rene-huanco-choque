<?php
declare(strict_types=1);

namespace App\Repository {

    use App\Entity\User;

    /**
     * IUserRepository Interface
     *
     * Defines the contract for any repository implementation that manages User entities.
     * It provides a set of methods for saving, updating, deleting, and retrieving users.
     */
    interface IUserRepository
    {
        /**
         * Save a User entity.
         *
         * This method persists a new user or overwrites an existing one based on its ID.
         *
         * @param User $user The user to be saved.
         */
        public function save(User $user): void;

        /**
         * Update an existing User entity.
         *
         * This method modifies an existing user in the repository. If the user does not exist,
         * the implementation may define its behavior (such as throwing an exception).
         *
         * @param User $user The user to update.
         */
        public function update(User $user): void;

        /**
         * Delete a User entity.
         *
         * Removes the specified user from the repository. If the user does not exist,
         * the implementation may silently ignore the operation.
         *
         * @param User $user The user to delete.
         */
        public function delete(User $user): void;

        /**
         * Retrieve a User by their ID.
         *
         * This method fetches a user by its unique ID, or returns `null` if no user with the provided ID exists.
         *
         * @param int $id The ID of the user to retrieve.
         * @return User|null The user if found, or `null` if not found.
         */
        public function getById(int $id): ?User;
    }
}