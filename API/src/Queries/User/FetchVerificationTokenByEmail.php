<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\User
{
    use Timetabio\API\Services\UserService;
    use Timetabio\Framework\ValueObjects\EmailAddress;

    class FetchVerificationTokenByEmailQuery
    {
        /**
         * @var UserService
         */
        private $userService;

        public function __construct(UserService $userService)
        {
            $this->userService = $userService;
        }

        public function execute(EmailAddress $token)
        {
            return $this->userService->getVerificationTokenByEmail($token);
        }
    }
}
