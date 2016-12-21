<?php
// @codeCoverageIgnoreStart
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Bootstrap
{
    use Timetabio\Framework\Configuration\ConfigurationInterface;
    use Timetabio\Framework\ErrorHandlers\AbstractErrorHandler;
    use Timetabio\Framework\Factories\MasterFactoryInterface;
    use Timetabio\Framework\Http\Request\DeleteRequest;
    use Timetabio\Framework\Http\Request\GetRequest;
    use Timetabio\Framework\Http\Request\PatchRequest;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\PutRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Routers\RouterInterface;
    use Timetabio\Framework\ValueObjects\Uri;

    abstract class AbstractBootstrapper
    {
        /**
         * @var ConfigurationInterface
         */
        private $configuration;

        /**
         * @var MasterFactoryInterface
         */
        private $factory;

        /**
         * @var RequestInterface
         */
        private $request;

        /**
         * @var RouterInterface
         */
        private $router;

        public function __construct()
        {
            $this->configuration = $this->buildConfiguration();
            $this->factory = $this->buildFactory();

            $this->buildErrorHandler()->register();

            $this->request = $this->buildRequest();
            $this->router = $this->buildRouter();

            $this->doBootstrap();
        }

        public function getRequest(): RequestInterface
        {
            return $this->request;
        }

        public function getRouter(): RouterInterface
        {
            return $this->router;
        }

        protected function getConfiguration(): ConfigurationInterface
        {
            return $this->configuration;
        }

        protected function getFactory(): MasterFactoryInterface
        {
            return $this->factory;
        }

        private function buildRequest(): RequestInterface
        {
            $uri = $this->buildUri();

            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                case 'HEAD':
                    return new GetRequest($uri, $_SERVER, $_COOKIE);
                case 'POST':
                    return new PostRequest($uri, $_SERVER, $_COOKIE, $this->parseBody(), $_FILES);
                case 'PATCH':
                    return new PatchRequest($uri, $_SERVER, $_COOKIE, $this->parseBody());
                case 'PUT':
                    return new PutRequest($uri, $_SERVER, $_COOKIE, $this->parseBody());
                case 'DELETE':
                    return new DeleteRequest($uri, $_SERVER, $_COOKIE);
            }

            throw new \RuntimeException('unsupported request method "' . $_SERVER['REQUEST_METHOD'] . '"');
        }

        private function parseBody(): array
        {
            if (!empty($_POST)) {
                return $_POST;
            }

            $input = file_get_contents('php://input', null, null, null, 1024 ** 2);

            switch ($_SERVER['CONTENT_TYPE']) {
                case 'application/json':
                    return json_decode($input, true);
                case 'application/x-www-form-urlencoded':
                    $data = [];
                    parse_str($input, $data);
                    return $data;
            }

            return [];
        }

        private function buildUri(): Uri
        {
            $scheme = 'http://';

            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
                $scheme = 'https://';
            }

            return new Uri($scheme . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        }

        abstract protected function doBootstrap();

        abstract protected function buildConfiguration(): ConfigurationInterface;

        abstract protected function buildFactory(): MasterFactoryInterface;

        abstract protected function buildRouter(): RouterInterface;

        abstract protected function buildErrorHandler(): AbstractErrorHandler;
    }
}
// @codeCoverageIgnoreEnd
