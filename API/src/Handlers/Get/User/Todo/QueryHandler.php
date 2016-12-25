<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Get\User\Todo
{
    use Timetabio\API\Models\ListModel;
    use Timetabio\API\Queries\User\FetchTodoTasksQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Mappers\PostMapper;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchTodoTasksQuery
         */
        private $fetchTodoTasksQuery;

        /**
         * @var PostMapper
         */
        private $postMapper;

        public function __construct(FetchTodoTasksQuery $fetchTodoTasksQuery, PostMapper $postMapper)
        {
            $this->fetchTodoTasksQuery = $fetchTodoTasksQuery;
            $this->postMapper = $postMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ListModel $model */

            $limit = $model->getLimit();
            $page = $model->getPage();
            $userId = $model->getAuthUserId();

            $posts = $this->fetchTodoTasksQuery->execute($userId, $limit, $page);

            foreach ($posts as $i => $post) {
                $posts[$i] = $this->postMapper->map($post);
            }

            $model->setData([
                'pagination' => [
                    'limit' => $limit,
                    'page' => $page
                ],
                'posts' => $posts
            ]);
        }
    }
}
