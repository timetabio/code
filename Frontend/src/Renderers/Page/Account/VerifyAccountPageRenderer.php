<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Page\Account
{
    use Timetabio\Framework\Backends\DomBackend;
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Framework\Http\StatusCodes\NotFound;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Renderers\Page\PageRendererInterface;

    class VerifyAccountPageRenderer implements PageRendererInterface
    {
        /**
         * @var DomBackend
         */
        private $domBackend;

        public function __construct(DomBackend $domBackend)
        {
            $this->domBackend = $domBackend;
        }

        public function render(PageModel $model, Document $template)
        {
            $fileName = 'templates://content/verify/success.html';

            if ($model->hasStatusCode() && $model->getStatusCode() instanceof NotFound) {
                $fileName = 'templates://content/verify/error.html';
            }

            $content = $this->domBackend->loadHtml($fileName);
            $contentElement = $template->importDocument($content);

            $template->getMainElement()->appendChild($contentElement);

            $header = $template->queryOne('//header[@class="page-header"]');

            if ($header !== null) {
                $header->parentNode->removeChild($header);
            }
        }
    }
}
