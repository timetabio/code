<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
