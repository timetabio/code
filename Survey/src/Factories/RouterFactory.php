<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class RouterFactory extends AbstractChildFactory
    {
        public function createBetaSurveyRouter(): \Timetabio\Survey\Routers\BetaSurveyRouter
        {
            return new \Timetabio\Survey\Routers\BetaSurveyRouter(
                $this->getMasterFactory(),
                $this->getMasterFactory()->createFetchBetaRequestQuery()
            );
        }

        public function createSurveyActionRouter(): \Timetabio\Survey\Routers\ActionRouter
        {
            return new \Timetabio\Survey\Routers\ActionRouter(
                $this->getMasterFactory()
            );
        }
    }
}
