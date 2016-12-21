<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Snippet
{
    use Timetabio\Framework\Dom;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\TabNavItems\FeedPage\People;
    use Timetabio\Frontend\TabNavItems\FeedPage\Posts;
    use Timetabio\Frontend\TabNavItems\FeedPage\Settings;
    use Timetabio\Frontend\Tabs\Tab;
    use Timetabio\Frontend\ValueObjects\Feed;
    use Timetabio\Library\Builders\UriBuilder;

    class FeedNavigationSnippet implements TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var TabNavSnippet
         */
        private $tabNavSnippet;

        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(TabNavSnippet $tabNavSnippet, UriBuilder $uriBuilder)
        {
            $this->tabNavSnippet = $tabNavSnippet;
            $this->uriBuilder = $uriBuilder;
        }

        public function render(Dom\Document $document, Tab $current, Feed $feed): Dom\Element
        {
            $feedId = $feed->getId();

            $items = [
                new Posts($this->uriBuilder->buildFeedPageUri($feedId)),
                new People($this->uriBuilder->buildFeedPeoplePageUri($feedId))
            ];

            if ($feed->hasUserAdded()) {
                $items[] = new Settings($this->uriBuilder->buildFeedOptionsPageUri($feedId));
            }

            $nav = $this->tabNavSnippet->render($document, $current, ...$items);
            $nav->setClassName('tab-nav -responsive');

            return $nav;
        }
    }
}
