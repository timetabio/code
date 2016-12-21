<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Snippet
{
    use Timetabio\Framework\Dom;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;

    class FeedInvitationBannerSnippet implements TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        public function render(Dom\Document $template): Dom\Element
        {
            $banner = $template->createElement('div');

            $banner->setClassName('page-banner');
            $banner->appendText($this->getTranslator()->translate('You have been invited to this feed. Add to gain extended access.'));

            return $banner;
        }
    }
}
