<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class SessionFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        /**
         * @var \Timetabio\Frontend\Session\Session
         */
        private $session;

        public function createSession()
        {
            if ($this->session === null) {
                $this->session = new \Timetabio\Frontend\Session\Session(
                    $this->getMasterFactory()->createDataStoreReader()
                );
            }

            return $this->session;
        }
    }
}
