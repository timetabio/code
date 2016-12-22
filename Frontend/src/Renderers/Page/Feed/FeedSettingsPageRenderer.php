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

    class FeedSettingsPageRenderer implements PageRendererInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        public function render(PageModel $model, Document $template)
        {
            /** @var FeedSettingsPageModel $model */

            $feed = $model->getFeed();
        }
    }
}
