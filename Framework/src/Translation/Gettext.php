<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Translation
{
    use Timetabio\Framework\Languages\LanguageInterface;

    class Gettext implements TranslatorInterface
    {
        public function translate(string $message, string $context = null): string
        {
            $lookupMessage = $this->buildLookupMessage($message, $context);
            $translation = gettext($lookupMessage);

            if ($translation === $lookupMessage) {
                return $message;
            }

            return $translation;
        }

        private function buildLookupMessage(string $message, string $context = null): string
        {
            $lookupContext = '';

            if ($context !== null) {
                $lookupContext = $context . "\004";
            }

            return $lookupContext . $message;
        }

        public function setUp(string $domain, string $directory)
        {
            bindtextdomain($domain, $directory);
            textdomain($domain);
        }

        public function setLanguage(LanguageInterface $language)
        {
            putenv('LC_ALL=' . $language);
            putenv('LANG=' . $language);
            putenv('LANGUAGE=' . $language);
            setlocale(LC_ALL, $language);
        }
    }
}
