<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Get\Random
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
                'number' => $this->getRandomNumber(),
            ]);
        }

        /**
         * @see https://xkcd.com/221/
         */
        private function getRandomNumber(): int
        {
            return 4; // chosen by fair dice roll.
                      // guaranteed to be random.
        }
    }
}
