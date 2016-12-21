<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Snippet
{
    use Timetabio\Framework\Dom;
    use Timetabio\Frontend\TabNavItems\TabNavItem;
    use Timetabio\Frontend\Tabs\Tab;

    class TabNavSnippet
    {
        /**
         * @var IconSnippet
         */
        private $iconSnippet;

        public function __construct(IconSnippet $iconSnippet)
        {
            $this->iconSnippet = $iconSnippet;
        }

        public function render(Dom\Document $document, Tab $activeTab, TabNavItem ...$items): Dom\Element
        {
            $navElement = $document->createElement('nav');
            $navElement->setClassName('tab-nav');

            foreach ($items as $item) {
                $itemClass = 'item';

                if ($item->getTab() == $activeTab) {
                    $itemClass = 'item -active';
                }

                $itemElement = $document->createElement('a');
                $itemElement->setClassName($itemClass);
                $itemElement->setAttribute('href', $item->getUri());
                $navElement->appendChild($itemElement);

                $iconElement = $this->iconSnippet->render($document, $item->getIcon(), 'icon');
                $itemElement->appendChild($iconElement);

                $labelElement = $document->createElement('span');
                $labelElement->appendText($item->getLabel());
                $itemElement->appendChild($labelElement);
            }

            return $navElement;
        }
    }
}
