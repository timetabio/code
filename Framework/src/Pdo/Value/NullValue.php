<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Pdo\Value
{
    class NullValue implements ValueInterface
    {
        public function getType(): int
        {
            return \PDO::PARAM_NULL;
        }

        public function getValue()
        {
            return null;
        }
    }
}
