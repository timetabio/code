<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Get\Index
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        public function execute(AbstractModel $model)
        {
            /** @var APIModel $model */
            $model->setData([
                'message' => 'welcome to the timetabio api'
            ]);
        }
    }
}
