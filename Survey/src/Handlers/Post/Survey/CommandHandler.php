<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Survey\Handlers\Post\Survey
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Survey\Commands\ApproveBetaRequestCommand;
    use Timetabio\Survey\Commands\InsertAnswerCommand;
    use Timetabio\Survey\Models\Action\SurveyActionModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var ApproveBetaRequestCommand
         */
        private $approveBetaRequestCommand;

        /**
         * @var InsertAnswerCommand
         */
        private $insertAnswerCommand;

        public function __construct(ApproveBetaRequestCommand $approveBetaRequestCommand, InsertAnswerCommand $insertAnswerCommand)
        {
            $this->approveBetaRequestCommand = $approveBetaRequestCommand;
            $this->insertAnswerCommand = $insertAnswerCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var SurveyActionModel $model */

            $betaRequest = $model->getBetaRequest();

            foreach ($model->getAnswers() as $id => $value) {
                $this->insertAnswerCommand->execute($id, $value, $betaRequest);
            }

            $this->approveBetaRequestCommand->execute($betaRequest);
        }
    }
}
