<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Feeds
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Feed\CreateModel;
    use Timetabio\API\ValueObjects\FeedDescription;
    use Timetabio\API\ValueObjects\FeedName;
    use Timetabio\API\ValueObjects\StringBoolean;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var CreateModel $model */
            /** @var PostRequest $request */

            if (!$request->hasParam('name')) {
                throw new BadRequest('missing parameter \'name\'', 'missing_parameter');
            }

            if (!$request->hasParam('is_private')) {
                throw new BadRequest('missing parameter \'is_private\'', 'missing_parameter');
            }

            try {
                $name = new FeedName($request->getParam('name'));
            } catch (\Exception $exception) {
                throw new BadRequest($exception->getMessage(), 'invalid_feed_name', $exception);
            }

            try {
                $private = new StringBoolean($request->getParam('is_private'));
            } catch (\Exception $exception) {
                throw new BadRequest('is_private must be a boolean', 'invalid_feed_is_private');
            }

            $model->setName($name);
            $model->setPrivate($private->getValue());
            $model->setDescription($this->getDescription($request));
        }

        private function getDescription(PostRequest $request): FeedDescription
        {
            if (!$request->hasParam('description')) {
                return new FeedDescription;
            }

            try {
                return new FeedDescription($request->getParam('description'));
            } catch (\Exception $exception) {
                throw new BadRequest($exception->getMessage(), 'invalid_feed_description', $exception);
            }
        }
    }
}
