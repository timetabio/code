<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\DataObjects
{
    use Timetabio\Framework\Http\StatusCodes\StatusCodeInterface;

    class StaticPage
    {
        /**
         * @var string
         */
        private $title;

        /**
         * @var string
         */
        private $content;

        /**
         * @var StatusCodeInterface
         */
        private $code;

        /**
         * @var bool
         */
        private $showHeader;

        public function __construct(string $title, string $content, StatusCodeInterface $code = null, bool $showHeader = true)
        {
            $this->title = $title;
            $this->content = $content;
            $this->code = $code;
            $this->showHeader = $showHeader;
        }

        public function getTitle(): string
        {
            return $this->title;
        }

        public function getContent(): string
        {
            return $this->content;
        }

        public function hasCode(): bool
        {
            return $this->code !== null;
        }

        public function getCode(): StatusCodeInterface
        {
            return $this->code;
        }

        public function getShowHeader(): bool
        {
            return $this->showHeader;
        }
    }
}
