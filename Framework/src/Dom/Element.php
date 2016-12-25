<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
