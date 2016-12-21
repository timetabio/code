<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Translation
{
    interface TranslatorAwareInterface
    {
        public function setTranslator(TranslatorInterface $translator);
    }
}
