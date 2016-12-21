<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\DataObjects
{
    class Question
    {
        /**
         * @var array
         */
        private $question;

        public function __construct(array $question)
        {
            $this->question = $question;
        }

        public function getId(): string
        {
            return $this->question['id'];
        }

        public function getTitle(): string
        {
            return $this->question['title'];
        }
    }
}
