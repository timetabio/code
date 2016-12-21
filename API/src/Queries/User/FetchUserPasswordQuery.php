<?php
namespace Timetabio\API\Queries\User
{
    use Timetabio\API\Services\UserService;

    class FetchUserPasswordQuery
    {
        /**
         * @var UserService
         */
        private $userService;

        public function __construct(UserService $userService)
        {
            $this->userService = $userService;
        }

        public function execute(string $id)
        {
            return $this->userService->getPassword($id);
        }
    }
}
