<?php

namespace App\Repository {

    use App\Entity\User;
    use App\Exception\UserDoesNotExistException;

    class UserRepository implements IUserRepository
    {
        private array $users = [];
        private int $nextId = 1;

        public function save(User $user): void
        {
            if ($user->getId() === null) {
                $user = new User($this->nextId++, $user->getName(), $user->getEmail(), $user->getPassword());
            }
            $this->users[$user->getId()] = $user;
        }

        public function update(User $user): void
        {
            $id = $user->getId();
            if (!$id || !isset($this->users[$id])) {
                throw new \InvalidArgumentException("Cannot update non-existent user.");
            }
            $this->users[$id] = $user;

        }

        public function delete(User $user): void
        {
            unset($this->users[$user->getId()]);
        }

        public function getById(int $id): ?User
        {
            return $this->users[$id] ?? null;
        }

        /**
         * @throws UserDoesNotExistException
         */
        public function getByIdOrFail(int $id): User
        {
            if (!isset($this->users[$id])) {
                throw new UserDoesNotExistException("User with ID $id does not exist.");
            }
            return $this->users[$id];

        }


        public function getAll(): array
        {
            return $this->users;
        }
    }
}