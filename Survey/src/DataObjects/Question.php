<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Survey\DataObjects
{
    class Question
    {
        /**
         * @var array
         */
        private $question;

        public function __construct(array $question)
        {
            $this->question = $question;
        }

        public function getId(): string
        {
            return $this->question['id'];
        }

        public function getTitle(): string
        {
            return $this->question['title'];
        }
    }
}
