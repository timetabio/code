<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\User
{
    use Timetabio\API\Services\UserService;
    use Timetabio\Framework\ValueObjects\Token;

    class FetchVerificationTokenQuery
    {
        /**
         * @var UserService
         */
        private $userService;

        public function __construct(UserService $userService)
        {
            $this->userService = $userService;
        }

        public function execute(Token $token)
        {
            return $this->userService->getVerificationToken($token);
        }
    }
}
