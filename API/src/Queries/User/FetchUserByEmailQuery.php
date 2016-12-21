<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\User
{
    use Timetabio\API\Services\UserService;
    use Timetabio\Framework\ValueObjects\EmailAddress;

    class FetchUserByEmailQuery
    {
        /**
         * @var UserService
         */
        private $userService;

        public function __construct(UserService $userService)
        {
            $this->userService = $userService;
        }

        public function execute(EmailAddress $email)
        {
            return $this->userService->getUserByEmail($email);
        }
    }
}
