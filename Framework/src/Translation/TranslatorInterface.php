<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Translation
{
    use Timetabio\Framework\Languages\LanguageInterface;

    interface TranslatorInterface
    {
        public function translate(string $message, string $context = null): string;

        public function setLanguage(LanguageInterface $language);
    }
}
