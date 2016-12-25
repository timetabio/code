<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
