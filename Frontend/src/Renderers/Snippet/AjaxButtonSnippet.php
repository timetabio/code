<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Renderers\Snippet
{
    use Timetabio\Framework\Dom\Element;

    /**
     * @todo: maybe figure out a different name, because this is technically not really a snippet
     */
    class AjaxButtonSnippet
    {
        public function render(Element $button, string $uri, array $data)
        {
            $button->setAttribute('is', 'ajax-button');
            $button->setAttribute('post-uri', $uri);
            $button->setAttribute('post-data', json_encode($data));
        }
    }
}
