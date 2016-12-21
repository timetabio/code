<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Exceptions
{
    use Timetabio\Framework\Http\StatusCodes\StatusCodeInterface;

    abstract class AbstractException extends \Exception
    {
        /**
         * @var string
         */
        private $id;

        public function __construct(string $message, string $id, \Exception $previous = null)
        {
            parent::__construct($message, 0, $previous);

            $this->id = $id;
        }

        public function getId(): string
        {
            return $this->id;
        }

        abstract public function getStatusCode(): StatusCodeInterface;
    }
}
