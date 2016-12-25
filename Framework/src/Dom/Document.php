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
    /**
     * @method Element createElement(string $name, string $value = null)
     * @method Fragment createDocumentFragment()
     */
    class Document extends \DOMDocument
    {
        /**
         * @var \DOMXPath
         */
        private $xpath;

        public function __construct(string $version = '1.0', string $encoding = 'utf-8')
        {
            parent::__construct($version, $encoding);

            libxml_use_internal_errors(true);

            $this->registerNodeClasses();
        }

        public function loadHTML($source, $options = 0)
        {
            parent::loadHTML(mb_convert_encoding($source, 'HTML-ENTITIES', 'UTF-8'), $options);

            $errors = libxml_get_errors();
            libxml_clear_errors();

            /** @var \LibXMLError $error */
            foreach ($errors as $error) {
                // ignore XML_HTML_UNKNOWN_TAG
                if ($error->code === 801) {
                    continue;
                }

                throw new Exception($error->message, $error->code);
            }

            return true;
        }

        public function createHTMLFragment(string $source): Fragment
        {
            $document = new Document;
            $document->loadHTML('<fragment>' . $source . '</fragment>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $fragment = $this->createDocumentFragment();

            foreach ($document->documentElement->childNodes as $node) {
                $fragment->appendChild($this->importNode($node, true));
            }

            return $fragment;
        }

        private function registerNodeClasses()
        {
            $this->registerNodeClass(\DOMNode::class, Node::class);
            $this->registerNodeClass(\DOMElement::class, Element::class);
            $this->registerNodeClass(\DOMDocumentFragment::class, Fragment::class);
        }

        public function query(string $query, \DOMNode $targetNode = null): \DOMNodeList
        {
            return $this->getXpath()->query($query, $targetNode);
        }

        /**
         * @return Node|null
         */
        public function queryOne(string $query, \DOMNode $targetNode = null)
        {
            return $this->query($query, $targetNode)->item(0);
        }

        public function getXpath(): \DOMXPath
        {
            if ($this->xpath === null) {
                $this->xpath = new \DOMXPath($this);
            }

            return $this->xpath;
        }

        public function getMainElement(): \DOMElement
        {
            return $this->queryOne('//main');
        }

        public function importDocument(\DOMDocument $document): \DOMNode
        {
            return $this->importNode($document->documentElement, true);
        }
    }
}
