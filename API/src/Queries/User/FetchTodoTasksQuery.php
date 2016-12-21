<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\User
{
    use Timetabio\API\Services\PostService;
    use Timetabio\API\ValueObjects\UserId;

    class FetchTodoTasksQuery
    {
        /**
         * @var PostService
         */
        private $postService;

        public function __construct(PostService $postService)
        {
            $this->postService = $postService;
        }

        public function execute(UserId $userId, int $limit, int $page): array
        {
            return $this->postService->getTodoTasks($userId, $limit, $page);
        }
    }
}
