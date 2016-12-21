<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Snippet
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Framework\Dom\Element;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\TabNavItems\Homepage\Feeds;
    use Timetabio\Frontend\TabNavItems\Homepage\Posts;
    use Timetabio\Frontend\Tabs\Tab;

    class HomepageNavigationSnippet implements TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var TabNavSnippet
         */
        private $tabNavSnippet;

        public function __construct(TabNavSnippet $tabNavSnippet)
        {
            $this->tabNavSnippet = $tabNavSnippet;
        }

        public function render(Document $document, Tab $current): Element
        {
            $nav = $this->tabNavSnippet->render($document, $current, new Posts, new Feeds);

            $nav->setClassName('tab-nav -margin');

            return $nav;
        }
    }
}
