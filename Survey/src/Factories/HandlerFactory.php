<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class HandlerFactory extends AbstractChildFactory
    {
        public function createSurveyPageTransformationHandler(): \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler(
                $this->getMasterFactory()->createSurveyPageRenderer()
            );
        }

        public function createSurveyPageQueryHandler(): \Timetabio\Survey\Handlers\Get\SurveyPage\QueryHandler
        {
            return new \Timetabio\Survey\Handlers\Get\SurveyPage\QueryHandler(
                $this->getMasterFactory()->createFetchQuestionsQuery()
            );
        }

        public function createSurveyActionRequestHandler(): \Timetabio\Survey\Handlers\Post\Survey\RequestHandler
        {
            return new \Timetabio\Survey\Handlers\Post\Survey\RequestHandler;
        }

        public function createSurveyActionQueryHandler(): \Timetabio\Survey\Handlers\Post\Survey\QueryHandler
        {
            return new \Timetabio\Survey\Handlers\Post\Survey\QueryHandler(
                $this->getMasterFactory()->createFetchBetaRequestQuery(),
                $this->getMasterFactory()->createFetchQuestionsQuery(),
                $this->getMasterFactory()->createUriBuilder()
            );
        }

        public function createSurveyActionCommandHandler(): \Timetabio\Survey\Handlers\Post\Survey\CommandHandler
        {
            return new \Timetabio\Survey\Handlers\Post\Survey\CommandHandler(
                $this->getMasterFactory()->createApproveBetaRequestCommand(),
                $this->getMasterFactory()->createInsertAnswerCommand()
            );
        }
    }
}
