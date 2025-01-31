<?php

declare(strict_types=1);

namespace Tests {

    use PHPUnit\Framework\Attributes\Test;
    use PHPUnit\Framework\MockObject\Exception;
    use PHPUnit\Framework\TestCase;
    use App\UseCase\SaveUserUseCase;
    use App\DTO\UserRequestDTO;
    use App\Entity\User;
    use App\Repository\IUserRepository;

    /**
     * SaveUserUseCaseTest Class
     *
     * This class contains unit tests for the SaveUserUseCase,
     * which handles the creation and persistence of users in the repository.
     */
    class SaveUserUseCaseTest extends TestCase
    {
        /**
         * Test to ensure that the `execute` method of SaveUserUseCase correctly saves a user.
         *
         * This test validates:
         * - That the `save` method of the repository is called exactly once.
         * - That the `User` object passed to the repository contains the expected values (name, email, and password).
         *
         * @throws Exception If an error occurs while creating or using the repository mock.
         */
        #[Test]
        public function executeSavesUser()
        {
            $repositoryMock = $this->createMock(IUserRepository::class);

            $requestDTO = new UserRequestDTO(
                name: 'John Doe',
                email: 'johndoe@example.com',
                password: 'Pa$$w0rd!'
            );

            $repositoryMock->expects($this->once()) // Expect the `save` method to be called once
            ->method('save')
                ->with($this->callback(function (User $user) {
                    return $user->getName() === 'John Doe' // Validate the name
                        && $user->getEmail() === 'johndoe@example.com' // Validate the email
                        && password_verify('Pa$$w0rd!', $user->getPassword()); // Validate the password (hashed)
                }));

            $useCase = new SaveUserUseCase($repositoryMock);
            $useCase->execute($requestDTO);
        }
    }
}