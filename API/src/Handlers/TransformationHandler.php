<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\Framework\Handlers\TransformationHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class TransformationHandler implements TransformationHandlerInterface
    {
        public function execute(AbstractModel $model): string
        {
            /** @var APIModel $model */

            return json_encode($model->getData(), JSON_PRETTY_PRINT) . PHP_EOL;
        }
    }
}
