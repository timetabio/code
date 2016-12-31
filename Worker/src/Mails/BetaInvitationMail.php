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
    class BetaInvitationMail extends AbstractMail
    {
        /**
         * @var string
         */
        private $betaRequestId;

        public function setBetaRequestId(string $betaRequestId)
        {
            $this->betaRequestId = $betaRequestId;
        }

        public function getSubject(): string
        {
            return 'timetab.io Private Beta';
        }

        public function render(): string
        {
            $template = $this->getTemplate();
            $template->getXpath()->registerNamespace('xhtml', 'http://www.w3.org/1999/xhtml');

            $surveyUri = 'https://survey.timetab.io/beta/' . $this->betaRequestId;

            $button = $template->queryOne('//*[@id="button"]');
            $button->setAttribute('href', $surveyUri);

            $link = $template->queryOne('//*[@id="link"]');
            $link->setAttribute('href', $surveyUri);
            $link->appendText($surveyUri);

            return $template->saveXML(null,LIBXML_NOEMPTYTAG);
        }
    }
}
