<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\Models\Action
{
    use Timetabio\Frontend\Models\ActionModel;

    class SurveyActionModel extends ActionModel
    {
        /**
         * @var string
         */
        private $betaRequest;

        /**
         * @var array
         */
        private $questions;

        /**
         * @var array
         */
        private $answers = [];

        /**
         * @var array
         */
        private $rawAnswers;

        public function getBetaRequest(): string
        {
            return $this->betaRequest;
        }

        public function setBetaRequest(string $betaRequest)
        {
            $this->betaRequest = $betaRequest;
        }

        public function getQuestions(): array
        {
            return $this->questions;
        }

        public function setQuestions(array $questions)
        {
            $this->questions = $questions;
        }

        public function getAnswers(): array
        {
            return $this->answers;
        }

        public function addAnswer(string $id, int $value)
        {
            $this->answers[$id] = $value;
        }

        public function getRawAnswers(): array
        {
            return $this->rawAnswers;
        }

        public function setRawAnswers(array $rawAnswers)
        {
            $this->rawAnswers = $rawAnswers;
        }
    }
}
