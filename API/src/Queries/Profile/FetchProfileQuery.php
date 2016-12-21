<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\Profile
{
    use Timetabio\API\Services\UserService;

    class FetchProfileQuery
    {
        /**
         * @var UserService
         */
        private $userService;

        public function __construct(UserService $userService)
        {
            $this->userService = $userService;
        }

        public function execute(string $username)
        {
            return $this->userService->getProfile($username);
        }
    }
}
