<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\ValueObjects
{
    use Timetabio\API\Access\AccessTypes\AccessTypeInterface;
    use Timetabio\Framework\ValueObjects\Token;

    class AccessToken implements \JsonSerializable
    {
        /**
         * @var Token
         */
        private $token;

        /**
         * @var AccessTypeInterface
         */
        private $accessType;

        /**
         * @var UserId
         */
        private $userId;

        /**
         * @var bool
         */
        private $autoRenew;

        /**
         * @var int
         */
        private $expires;

        public function __construct(
            Token $token,
            AccessTypeInterface $accessType,
            UserId $userId = null,
            bool $autoRenew = false,
            int $expires = 30 * 24 * 60 * 60
        )
        {
            $this->token = $token;
            $this->accessType = $accessType;
            $this->userId = $userId;
            $this->autoRenew = $autoRenew;
            $this->expires = $expires;
        }

        public function getToken(): Token
        {
            return $this->token;
        }

        public function getAccessType(): AccessTypeInterface
        {
            return $this->accessType;
        }

        public function hasUserId(): bool
        {
            return $this->userId !== null;
        }

        public function getUserId(): UserId
        {
            return $this->userId;
        }

        public function getExpires(): int
        {
            return $this->expires;
        }

        public function getAutoRenew(): bool
        {
            return $this->autoRenew;
        }

        public function jsonSerialize(): array
        {
            return [
                'token' => (string) $this->token,
                'userId' => $this->userId,
                'expires' => $this->expires,
                'auto_renew' => $this->autoRenew
            ];
        }
    }
}
