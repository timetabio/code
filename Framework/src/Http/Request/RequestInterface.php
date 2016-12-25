<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Http\Request
{
    use Timetabio\Framework\Http\Headers\Authorization;
    use Timetabio\Framework\Languages\LanguageInterface;
    use Timetabio\Framework\ValueObjects\Uri;

    interface RequestInterface
    {
        public function getUri(): Uri;

        public function getQueryParam(string $param): string;

        public function hasQueryParam(string $param): bool;

        public function getUserAgent(): string;

        public function getUserIp(): string;

        public function getAuthorization(): Authorization;

        public function hasAuthorization(): bool;

        public function hasCookie(string $name): bool;

        public function getCookie(string $name): string;

        public function getLanguage(): LanguageInterface;

        public function isDnt(): bool;
    }
}
