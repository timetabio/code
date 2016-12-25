<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\BetaRequest
{
    use Timetabio\API\Commands\BetaRequest\CreateBetaRequestCommand;
    use Timetabio\API\Models\BetaRequest\CreateModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var CreateBetaRequestCommand
         */
        private $createBetaRequestCommand;

        public function __construct(CreateBetaRequestCommand $createBetaRequestCommand)
        {
            $this->createBetaRequestCommand = $createBetaRequestCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var CreateModel $model */

            $model->setData(
                $this->createBetaRequestCommand->execute($model->getEmail())
            );
        }
    }
}
