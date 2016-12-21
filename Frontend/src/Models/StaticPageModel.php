<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models
{
    use Timetabio\Framework\Languages\LanguageInterface;
    use Timetabio\Library\DataObjects\StaticPage;

    class StaticPageModel extends PageModel
    {
        /**
         * @var string
         */
        private $name;

        /**
         * @var LanguageInterface
         */
        private $language;

        /**
         * @var StaticPage
         */
        private $staticPage;

        public function __construct(string $name, LanguageInterface $language)
        {
            $this->name = $name;
            $this->language = $language;
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function getLanguage(): LanguageInterface
        {
            return $this->language;
        }

        public function getStaticPage(): StaticPage
        {
            return $this->staticPage;
        }

        public function setStaticPage(StaticPage $staticPage)
        {
            $this->staticPage = $staticPage;
        }
    }
}
