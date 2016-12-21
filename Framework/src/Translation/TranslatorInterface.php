<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Translation
{
    use Timetabio\Framework\Languages\LanguageInterface;

    interface TranslatorInterface
    {
        public function translate(string $message, string $context = null): string;

        public function setLanguage(LanguageInterface $language);
    }
}
