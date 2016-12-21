<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Snippet
{
    use Timetabio\Framework\Dom;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\ValueObjects\PaginatedResult;

    class PaginationButtonSnippet implements TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        public function render(Dom\Document $template, PaginatedResult $posts): \DOMNode
        {
            if ($posts->getPage() >= $posts->getPages()) {
                return $template->createDocumentFragment();
            }

            $paginationButton = $template->createElement('button');
            $paginationButton->setClassName('pagination-button');
            $paginationButton->setAttribute('is', 'pagination-button');
            $paginationButton->setAttribute('loading-text', $this->getTranslator()->translate('Loading') . '...');
            $paginationButton->setAttribute('idle-text', $this->getTranslator()->translate('Load more'));

            return $paginationButton;
        }
    }
}
