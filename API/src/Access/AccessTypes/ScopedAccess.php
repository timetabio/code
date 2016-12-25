<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Access\AccessTypes
{
    class ScopedAccess implements AccessTypeInterface, \JsonSerializable
    {
        /**
         * @var array
         */
        private $scopes;

        /**
         * @var array
         */
        private $allowedScopes = [
            'user:read' => 1,
            'user:write' => 1,
            'collections:read' => 1,
            'collections:write' => 1,
            'public' => 1,
            'feeds:read' => 1,
            'feeds:write' => 1,
            'feeds:post' => 1
        ];

        public function __construct(array $scopes)
        {
            $this->validate($scopes);

            $this->scopes = array_flip($scopes);
        }

        private function validate(array $scopes)
        {
            foreach ($scopes as $scope) {
                if (!isset($this->allowedScopes[$scope])) {
                    throw new \Exception('invalid scope \'' . $scope . '\'');
                }
            }
        }

        public function hasScope(string $scope): bool
        {
            return isset($this->scopes[$scope]);
        }

        public function jsonSerialize(): array
        {
            return array_keys($this->scopes);
        }
    }
}
