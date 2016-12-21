<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
