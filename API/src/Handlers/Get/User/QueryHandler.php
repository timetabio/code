<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Get\User
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\API\Queries\User\FetchUserByIdQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Mappers\DocumentMapper;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchUserByIdQuery
         */
        private $fetchUserByIdQuery;

        /**
         * @var DocumentMapper
         */
        private $userMapper;

        public function __construct(FetchUserByIdQuery $fetchUserByIdQuery, DocumentMapper $userMapper)
        {
            $this->fetchUserByIdQuery = $fetchUserByIdQuery;
            $this->userMapper = $userMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var APIModel $model */

            $data = $this->fetchUserByIdQuery->execute(
                $model->getAuthUserId()
            );

            $user = $this->userMapper->map($data);

            $model->setData($user);
        }
    }
}
