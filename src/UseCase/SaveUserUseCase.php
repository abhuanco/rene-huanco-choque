<?php
declare(strict_types=1);

namespace App\UseCase {

    use App\DTO\UserRequestDTO;
    use App\Entity\User;
    use App\Repository\IUserRepository;

    readonly class SaveUserUseCase
    {
        public function __construct(private IUserRepository $repository)
        {
        }

        public function execute(UserRequestDTO $request): void
        {
            $user = new User(null, $request->name, $request->email, $request->password);
            $this->repository->save($user);
        }
    }
}
