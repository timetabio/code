<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\ValueObjects
{
    class InkResult
    {
        /**
         * @var string
         */
        private $body;

        /**
         * @var string
         */
        private $preview;

        /**
         * @var string
         */
        private $plainText;

        public function __construct(string $body = '', string $preview = '', string $plainText = '')
        {
            $this->body = $body;
            $this->preview = $preview;
            $this->plainText = $plainText;
        }

        public function getBody(): string
        {
            return $this->body;
        }

        public function getPreview(): string
        {
            return $this->preview;
        }

        public function getPlainText(): string
        {
            return $this->plainText;
        }
    }
}
