<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Worker\Mails
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Library\Builders\UriBuilder;

    class VerificationMail extends AbstractMail
    {
        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        /**
         * @var string
         */
        private $token;

        public function __construct(Document $template, UriBuilder $uriBuilder)
        {
            parent::__construct($template);

            $this->uriBuilder = $uriBuilder;
        }

        public function setToken(string $token)
        {
            $this->token = $token;
        }

        public function getSubject(): string
        {
            return 'Verify your timetab.io account';
        }

        public function render(): string
        {
            $template = $this->getTemplate();
            $links = $template->getElementsByTagName('a');

            $uri = $this->uriBuilder->buildVerificationUri($this->token);

            $links->item(1)->setAttribute('href', $uri);

            $alternate = $links->item(2);

            $alternate->setAttribute('href', $uri);
            $alternate->appendChild($template->createTextNode($uri));

            return $template->saveHTML();
        }
    }
}
