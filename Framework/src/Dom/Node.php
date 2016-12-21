<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Dom
{
    class Node extends \DOMNode
    {
        public function appendText(string $text): \DOMText
        {
            return $this->appendChild($this->ownerDocument->createTextNode($text));
        }
    }
}
