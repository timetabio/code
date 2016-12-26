<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Page\Feed
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Models\Page\FeedSettingsPageModel;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Renderers\Page\PageRendererInterface;
    use Timetabio\Frontend\Renderers\Snippet\IconButtonSnippet;

    class FeedSettingsPageRenderer implements PageRendererInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var IconButtonSnippet
         */
        private $iconButtonSnippet;

        public function __construct(IconButtonSnippet $iconButtonSnippet)
        {
            $this->iconButtonSnippet = $iconButtonSnippet;
        }

        public function render(PageModel $model, Document $template)
        {
            /** @var FeedSettingsPageModel $model */

            $feed = $model->getFeed();
            $main = $template->getMainElement();

            $wrapper = $template->createElement('div');
            $wrapper->setClassName('page-wrapper -padding');
            $main->appendChild($wrapper);

            $feedNameTitle = $template->createElement('h2');
            $feedNameTitle->setClassName('basic-heading-b _margin-after-s');
            $feedNameTitle->appendText('Feed Name');
            $wrapper->appendChild($feedNameTitle);

            //
            // Feed Name
            //

            $feedNameForm = $template->createElement('form');
            $feedNameForm->setClassName('form-card _margin-after-l');
            $feedNameForm->setAttribute('is', 'ajax-form');
            $feedNameForm->setAttribute('action', '/action/feed/update-name');
            $wrapper->appendChild($feedNameForm);

            $feedNameInput = $template->createElement('input');
            $feedNameInput->setClassName('text');
            $feedNameInput->setAttribute('name', 'name');
            $feedNameInput->setAttribute('placeholder', 'Explorations of Space-Time');
            $feedNameInput->setAttribute('required', '');
            $feedNameInput->setAttribute('value', $feed->getName());
            $feedNameForm->appendChild($feedNameInput);

            $feedIdInput = $template->createElement('input');
            $feedIdInput->setAttribute('type', 'hidden');
            $feedIdInput->setAttribute('name', 'feed_id');
            $feedIdInput->setAttribute('value', $feed->getId());
            $feedNameForm->appendChild($feedIdInput);

            $feedNameSaveButton = $this->iconButtonSnippet->render($template, 'done', 'Save', '-color');
            $feedNameSaveButton->setAttribute('type', 'submit');
            $feedNameForm->appendChild($feedNameSaveButton);


            //
            // Feed Description
            //

            $feedDescriptionTitle = $template->createElement('h2');
            $feedDescriptionTitle->setClassName('basic-heading-b _margin-after-s');
            $feedDescriptionTitle->appendText('Feed Description');
            $wrapper->appendChild($feedDescriptionTitle);

            $feedDescriptionForm = $template->createElement('form');
            $feedDescriptionForm->setClassName('form-card _margin-after-l');
            $feedDescriptionForm->setAttribute('is', 'ajax-form');
            $feedDescriptionForm->setAttribute('action', '/action/feed/update-description');
            $wrapper->appendChild($feedDescriptionForm);

            $feedDescriptionInput = $template->createElement('input');
            $feedDescriptionInput->setClassName('text');
            $feedDescriptionInput->setAttribute('name', 'description');
            $feedDescriptionInput->setAttribute('placeholder', 'Describe your feed in a few short words');
            $feedDescriptionInput->setAttribute('value', $feed->getDescription());
            $feedDescriptionForm->appendChild($feedDescriptionInput);

            $feedIdInput = $template->createElement('input');
            $feedIdInput->setAttribute('type', 'hidden');
            $feedIdInput->setAttribute('name', 'feed_id');
            $feedIdInput->setAttribute('value', $feed->getId());
            $feedDescriptionForm->appendChild($feedIdInput);

            $feedDescriptionSaveButton = $this->iconButtonSnippet->render($template, 'done', 'Save', '-color');
            $feedDescriptionSaveButton->setAttribute('type', 'submit');
            $feedDescriptionForm->appendChild($feedDescriptionSaveButton);

            //
            // Feed URL
            //

            $feedUrlTitle = $template->createElement('h2');
            $feedUrlTitle->setClassName('basic-heading-b _margin-after-s');
            $feedUrlTitle->appendText('URL');
            $wrapper->appendChild($feedUrlTitle);

            $feedUrlForm = $template->createElement('form');
            $feedUrlForm->setClassName('form-card');
            $feedUrlForm->setAttribute('is', 'ajax-form');
            $feedUrlForm->setAttribute('action', '/action/feed/update-vanity');
            $wrapper->appendChild($feedUrlForm);

            $feedUrlText = $template->createElement('span');
            $feedUrlText->setClassName('text');
            $feedUrlForm->appendChild($feedUrlText);

            $feedUrlMeta = $template->createElement('span');
            $feedUrlMeta->setClassName('meta');
            $feedUrlMeta->appendText('timetab.io/feed/');
            $feedUrlText->appendChild($feedUrlMeta);

            $feedUrlInput = $template->createElement('input');
            $feedUrlInput->setClassName('content');
            $feedUrlInput->setAttribute('is', 'validated-input');
            $feedUrlInput->setAttribute('max-byte-size', '20');
            $feedUrlInput->setAttribute('pattern', '[\w-]+');
            $feedUrlInput->setAttribute('name', 'vanity');
            $feedUrlInput->setAttribute('placeholder', 'your-feed-name');
            $feedUrlInput->setAttribute('value', $feed->getVanity());
            $feedUrlText->appendChild($feedUrlInput);

            $feedIdInput = $template->createElement('input');
            $feedIdInput->setAttribute('type', 'hidden');
            $feedIdInput->setAttribute('name', 'feed_id');
            $feedIdInput->setAttribute('value', $feed->getId());
            $feedUrlForm->appendChild($feedIdInput);

            $feedUrlSaveButton = $this->iconButtonSnippet->render($template, 'done', 'Save', '-color');
            $feedUrlSaveButton->setAttribute('type', 'submit');
            $feedUrlForm->appendChild($feedUrlSaveButton);
        }
    }
}
