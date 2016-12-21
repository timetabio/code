<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\User
{
    use Timetabio\API\Services\UserService;
    use Timetabio\API\ValueObjects\UserId;

    class FetchUserByIdQuery
    {
        /**
         * @var UserService
         */
        private $userService;

        public function __construct(UserService $userService)
        {
            $this->userService = $userService;
        }

        public function execute(string $userId)
        {
            return $this->userService->getUserById($userId);
        }
    }
}
