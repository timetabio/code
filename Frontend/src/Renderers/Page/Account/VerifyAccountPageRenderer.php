<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Renderers\Page\Account
{
    use Timetabio\Framework\Backends\DomBackend;
    use Timetabio\Framework\Dom\Document;
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
            $content = $this->domBackend->loadHtml('templates://content/verify/success.html');
            $contentElement = $template->importDocument($content);

            $template->getMainElement()->appendChild($contentElement);

            $header = $template->queryOne('//header[@class="page-header"]');

            if ($header !== null) {
                $header->parentNode->removeChild($header);
            }
        }
    }
}
