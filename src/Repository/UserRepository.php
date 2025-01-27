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
            if (isset($this->users[$user->getId()])) {
                $this->users[$user->getId()] = $user;
            }
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
            $user = $this->getById($id);

            if (!$user) {
                throw new UserDoesNotExistException("User with ID $id does not exist.");
            }

            return $user;
        }


        public function getAll(): array
        {
            return $this->users;
        }
    }
}