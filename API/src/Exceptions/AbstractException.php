<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
