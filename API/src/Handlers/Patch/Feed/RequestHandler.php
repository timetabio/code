<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Patch\Feed
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Feed\UpdateModel;
    use Timetabio\API\ValueObjects\FeedDescription;
    use Timetabio\API\ValueObjects\FeedName;
    use Timetabio\API\ValueObjects\FeedVanity;
    use Timetabio\API\ValueObjects\StringBoolean;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PatchRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PatchRequest $request */
            /** @var UpdateModel $model */

            if ($request->hasParam('name')) {
                $model->addUpdate('name', $this->getName($request));
            }

            if ($request->hasParam('description')) {
                $model->addUpdate('description', $this->getDescription($request));
            }

            if ($request->hasParam('is_private')) {
                $model->addUpdate('is_private', $this->getIsPrivate($request));
            }

            if ($request->hasParam('vanity')) {
                $model->setFeedVanity($this->getVanity($request));
            }
        }

        private function getVanity(PatchRequest $request): string
        {
            $vanity = $request->getParam('vanity');

            if ($vanity === '') {
                return $vanity;
            }

            try {
                return new FeedVanity($vanity);
            } catch (\Exception $exception) {
                throw new BadRequest('invalid vanity name', 'invalid_vanity', $exception);
            }
        }

        private function getIsPrivate(PatchRequest $request): bool
        {
            try {
                $raw = $request->getParam('is_private');

                return (new StringBoolean($raw))->getValue();
            } catch (\Exception $exception) {
                throw new BadRequest('invalid boolean value must be 1 or 0', 'invalid_is_private', $exception);
            }
        }

        private function getName(PatchRequest $request): FeedName
        {
            try {
                return new FeedName($request->getParam('name'));
            } catch (\Exception $exception) {
                throw new BadRequest($exception->getMessage(), 'invalid_feed_name', $exception);
            }
        }

        private function getDescription(PatchRequest $request): FeedDescription
        {
            try {
                return new FeedDescription($request->getParam('description'));
            } catch (\Exception $exception) {
                throw new BadRequest($exception->getMessage(), 'invalid_description', $exception);
            }
        }
    }
}
