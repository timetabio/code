<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Http\Request
{
    use Timetabio\Framework\ValueObjects\Uri;

    abstract class AbstractWriteRequest extends AbstractRequest implements WriteRequestInterface
    {
        /**
         * @var array
         */
        private $body;

        public function __construct(Uri $uri, array $server, array $cookies, array $body)
        {
            parent::__construct($uri, $server, $cookies);

            $this->body = $body;
        }

        public function hasParam(string $name): bool
        {
            return isset($this->body[$name]);
        }

        public function getParam(string $name)
        {
            if (!isset($this->body[$name])) {
                throw new \Exception('param with name "' . $name . '" was not found in request');
            }

            return $this->body[$name];
        }
    }
}
