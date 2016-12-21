<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
