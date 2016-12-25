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

            $feedDescriptionTitle = $template->createElement('h2');
            $feedDescriptionTitle->setClassName('basic-heading-b _margin-after-s');
            $feedDescriptionTitle->appendText('Feed Description');
            $wrapper->appendChild($feedDescriptionTitle);

            $feedDescriptionForm = $template->createElement('form');
            $feedDescriptionForm->setClassName('form-card');
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
        }
    }
}
