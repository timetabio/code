<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Http\Redirect
{
    use Timetabio\Framework\ValueObjects\Uri;

    abstract class AbstractRedirect implements RedirectInterface
    {
        /**
         * @var Uri
         */
        private $uri;

        public function __construct(Uri $uri)
        {
            $this->uri = $uri;
        }

        public function getUri(): Uri
        {
            return $this->uri;
        }
    }
}
