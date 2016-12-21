<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class CommandFactory extends AbstractChildFactory
    {
        public function createApproveBetaRequestCommand(): \Timetabio\Survey\Commands\ApproveBetaRequestCommand
        {
            return new \Timetabio\Survey\Commands\ApproveBetaRequestCommand(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }

        public function createInsertAnswerCommand(): \Timetabio\Survey\Commands\InsertAnswerCommand
        {
            return new \Timetabio\Survey\Commands\InsertAnswerCommand(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }
    }
}
