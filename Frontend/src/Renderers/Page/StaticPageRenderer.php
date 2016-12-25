<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Renderers\Page
{
    use Timetabio\Framework\Backends\DomBackend;
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Models\StaticPageModel;

    class StaticPageRenderer implements PageRendererInterface
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
            /** @var StaticPageModel $model */

            $staticPage = $model->getStaticPage();

            $content = new Document;
            $content->loadHTML($staticPage->getContent(), LIBXML_HTML_NOIMPLIED);

            $header = $template->queryOne('//header[@class="page-header"]');

            $main = $template->queryOne('//main');

            $main->appendChild($template->importNode($content->documentElement, true));

            if (!$staticPage->getShowHeader() && $header) {
                $header->parentNode->removeChild($header);
            }
        }
    }
}
