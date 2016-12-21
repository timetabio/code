<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands\User
{
    use Timetabio\API\Services\UserService;
    use Timetabio\API\ValueObjects\UserId;

    class UpdateUserCommand
    {
        /**
         * @var UserService
         */
        private $userService;

        public function __construct(UserService $userService)
        {
            $this->userService = $userService;
        }

        public function execute(UserId $userId, array $data)
        {
            $this->userService->updateUser($userId, $data);
        }
    }
}
