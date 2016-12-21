<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Translation
{
    trait TranslatorAwareTrait
    {
        /**
         * @var TranslatorInterface
         */
        private $translator;

        public function setTranslator(TranslatorInterface $translator)
        {
            $this->translator = $translator;
        }

        protected function getTranslator(): TranslatorInterface
        {
            return $this->translator;
        }
    }
}
