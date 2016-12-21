<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Get\Profile
{
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Models\Profile\ProfileModel;
    use Timetabio\API\Queries\Profile\FetchProfileQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Mappers\DocumentMapper;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchProfileQuery
         */
        private $fetchProfileQuery;

        /**
         * @var DocumentMapper
         */
        private $documentMapper;

        public function __construct(FetchProfileQuery $fetchProfileQuery, DocumentMapper $documentMapper)
        {
            $this->fetchProfileQuery = $fetchProfileQuery;
            $this->documentMapper = $documentMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ProfileModel $model */

            $profile = $this->fetchProfileQuery->execute($model->getUsername());

            if ($profile === null) {
                throw new NotFound('profile not found', 'not_found');
            }

            $model->setData($this->documentMapper->map($profile));
        }
    }
}
