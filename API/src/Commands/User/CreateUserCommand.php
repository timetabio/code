<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands\User
{
    use Timetabio\API\Services\UserService;
    use Timetabio\API\ValueObjects\Password;
    use Timetabio\API\ValueObjects\Username;
    use Timetabio\Framework\ValueObjects\EmailAddress;
    use Timetabio\Framework\ValueObjects\Token;

    class CreateUserCommand
    {
        /**
         * @var UserService
         */
        private $userService;

        public function __construct(UserService $userService)
        {
            $this->userService = $userService;
        }

        public function execute(EmailAddress $email, Username $username, Password $password, Token $token): array
        {
            return $this->userService->createUser($email, $username, $password, $token);
        }
    }
}
