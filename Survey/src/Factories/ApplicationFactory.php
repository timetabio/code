<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Survey\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class ApplicationFactory extends AbstractChildFactory
    {
        public function createUriBuilder(): \Timetabio\Survey\Builders\UriBuilder
        {
            return new \Timetabio\Survey\Builders\UriBuilder(
                $this->getMasterFactory()->getConfiguration()->get('uriHost')
            );
        }
    }
}
