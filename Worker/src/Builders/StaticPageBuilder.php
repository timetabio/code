<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Builders
{
    use Timetabio\Framework\Backends\FileBackend;
    use Timetabio\Framework\Languages\LanguageInterface;
    use Timetabio\Framework\Translation\TranslatorInterface;
    use Timetabio\Library\DataObjects\StaticPage;
    use Timetabio\Worker\Locators\StatusCodeLocator;
    use Timetabio\Worker\Renderers\StaticPageRenderer;

    class StaticPageBuilder
    {
        /**
         * @var FileBackend
         */
        private $fileBackend;

        /**
         * @var StatusCodeLocator
         */
        private $statusCodeLocator;

        /**
         * @var StaticPageRenderer
         */
        private $staticPageRenderer;

        /**
         * @var TranslatorInterface
         */
        private $translator;

        public function __construct(
            FileBackend $fileBackend,
            StatusCodeLocator $statusCodeLocator,
            StaticPageRenderer $staticPageRenderer,
            TranslatorInterface $translator
        )
        {
            $this->fileBackend = $fileBackend;
            $this->statusCodeLocator = $statusCodeLocator;
            $this->staticPageRenderer = $staticPageRenderer;
            $this->translator = $translator;
        }

        public function build(string $name, LanguageInterface $language): StaticPage
        {
            $this->translator->setLanguage($language);

            $staticPage = json_decode($this->fileBackend->read('dataDir://pages/' . $name . '.json'), true);

            $content = $this->staticPageRenderer->render($staticPage['content']);
            $statusCode = null;
            $showHeader = true;

            if (isset($staticPage['code'])) {
                $statusCode = $this->statusCodeLocator->locate($staticPage['code']);
            }

            if (isset($staticPage['header'])) {
                $showHeader = $staticPage['header'];
            }

            return new StaticPage($staticPage['title'], $content, $statusCode, $showHeader);
        }
    }
}
