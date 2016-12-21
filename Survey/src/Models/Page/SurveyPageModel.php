<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\Models\Page
{
    use Timetabio\Frontend\Models\PageModel;

    class SurveyPageModel extends PageModel
    {
        /**
         * @var array
         */
        private $betaRequest;

        /**
         * @var array
         */
        private $questions;

        public function __construct(array $betaRequest)
        {
            $this->betaRequest = $betaRequest;
        }

        public function getBetaRequest(): array
        {
            return $this->betaRequest;
        }

        public function getQuestions(): array
        {
            return $this->questions;
        }

        public function setQuestions(array $questions)
        {
            $this->questions = $questions;
        }
    }
}
