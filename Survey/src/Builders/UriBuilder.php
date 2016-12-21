<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\Builders
{
    class UriBuilder
    {
        /**
         * @var string
         */
        private $uriHost;

        public function __construct($uriHost)
        {
            $this->uriHost = $uriHost;
        }

        public function buildSurveyThanksPage(): string
        {
            return $this->uriHost . '/survey/thanks';
        }
    }
}
