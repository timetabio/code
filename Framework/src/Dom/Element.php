<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Dom
{
    use DOMNode;

    /**
     * @property Document $ownerDocument
     */
    class Element extends \DOMElement
    {
        public function appendText(string $text): \DOMText
        {
            return $this->appendChild($this->ownerDocument->createTextNode($text));
        }

        public function appendChild(\DOMNode $node)
        {
            if ($node instanceof \DOMDocumentFragment && !$node->childNodes->length) {
                return $node;
            }

            return parent::appendChild($node);
        }

        public function queryOne(string $query)
        {
            return $this->ownerDocument->queryOne($query, $this);
        }

        public function query(string $query): \DOMNodeList
        {
            return $this->ownerDocument->query($query, $this);
        }

        public function setClassName(string $className)
        {
            $this->setAttribute('class', $className);
        }

        public function getAttribute($name)
        {
            if (!$this->hasAttribute($name)) {
                return null;
            }

            return parent::getAttribute($name);
        }
    }
}
