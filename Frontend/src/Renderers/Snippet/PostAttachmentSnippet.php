<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Snippet
{
    use Timetabio\Framework\Dom;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;

    class PostAttachmentSnippet implements TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var IconSnippet
         */
        private $iconSnippet;

        public function __construct(IconSnippet $iconSnippet)
        {
            $this->iconSnippet = $iconSnippet;
        }

        public function render(Dom\Document $document, array $attachment): Dom\Element
        {
            $attachmentElement = $document->createElement('div');
            $attachmentElement->setClassName('post-attachment');

            $attachmentElement->appendChild($this->iconSnippet->render($document, 'attachment', 'icon'));

            $linkElement = $document->createElement('a');
            $linkElement->setClassName('name');
            $linkElement->setAttribute('href', $attachment['url']);
            $linkElement->appendText($attachment['filename']);

            $attachmentElement->appendChild($linkElement);

            $downloadLinkElement = $document->createElement('a');
            $downloadLinkElement->setClassName('download');
            $downloadLinkElement->setAttribute('href', $attachment['url']);
            $downloadLinkElement->setAttribute('download', '');
            $downloadLinkElement->appendText($this->getTranslator()->translate('Download'));

            $attachmentElement->appendChild($downloadLinkElement);

            return $attachmentElement;
        }
    }
}
