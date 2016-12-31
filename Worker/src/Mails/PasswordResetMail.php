<?php
/**
 * Copyright (c) 2016 Manuel Lopez <manuel.lopez@stud.bbbaden.ch>
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

    class PasswordResetMail extends AbstractMail
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

        public function getToken(): string
        {
            return $this->token;
        }

        public function setToken(string $token)
        {
            $this->token = $token;
        }

        public function getSubject(): string
        {
            return 'Password Reset';
        }

        public function render(): string
        {
            $template = $this->getTemplate();
            $template->getXpath()->registerNamespace('xhtml', 'http://www.w3.org/1999/xhtml');

            $resetUri = $this->uriBuilder->buildResetPasswordPageUri($this->token);

            $greeting = $template->queryOne('//*[@id="greeting"]');
            $greeting->appendText($this->getRecipient()->getName());

            $button = $template->queryOne('//*[@id="button"]');
            $button->setAttribute('href', $resetUri);

            $link = $template->queryOne('//*[@id="link"]');
            $link->setAttribute('href', $resetUri);
            $link->appendText($resetUri);

            return $template->saveHTML();
        }
    }
}
