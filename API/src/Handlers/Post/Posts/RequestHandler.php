<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Posts
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Locators\PostTypeLocator;
    use Timetabio\API\Models\Post\CreateModel;
    use Timetabio\API\ValueObjects\Attachment;
    use Timetabio\API\ValueObjects\PostBody;
    use Timetabio\API\ValueObjects\PostTitle;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\ValueObjects\Timestamp;
    use Timetabio\Library\PostTypes\PostTypeInterface;

    class RequestHandler implements RequestHandlerInterface
    {
        /**
         * @var PostTypeLocator
         */
        private $postTypeLocator;

        /**
         * @var string[]
         */
        private $requiredParams = [
            'title',
            'body',
            'type'
        ];

        public function __construct(PostTypeLocator $postTypeLocator)
        {
            $this->postTypeLocator = $postTypeLocator;
        }

        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PostRequest $request */
            /** @var CreateModel $model */

            $this->checkRequiredArguments($request);

            $model->setPostType($this->getPostType($request));

            $parts = $request->getUri()->getPathSegments();
            $model->setFeedId($parts[2]);

            $model->setPostTitle($this->getPostTitle($request));
            $model->setPostBody($this->getPostBody($request));

            if ($request->hasParam('timestamp')) {
                $model->setPostTimestamp($this->getTimestamp($request));
            }

            $this->addAttachments($request, $model);
        }

        private function checkRequiredArguments(PostRequest $request)
        {
            foreach ($this->requiredParams as $param) {
                if (!$request->hasParam($param)) {
                    throw new BadRequest('missing parameter \'' . $param . '\'', 'missing_parameter');
                }
            }
        }

        private function getPostType(PostRequest $request): PostTypeInterface
        {
            try {
                return $this->postTypeLocator->locate($request->getParam('type'));
            } catch (\Exception $exception) {
                throw new BadRequest('invalid post type', 'invalid_type');
            }
        }

        private function getTimestamp(PostRequest $request): Timestamp
        {
            $timestamp = $request->getParam('timestamp');

            if (!ctype_digit($timestamp)) {
                throw new BadRequest('invalid timestamp', 'invalid_timestamp');
            }

            return new Timestamp($timestamp);
        }

        private function getPostBody(PostRequest $request): PostBody
        {
            try {
                return new PostBody($request->getParam('body'));
            } catch (\Exception $exception) {
                throw new BadRequest($exception->getMessage(), 'invalid_post_body');
            }
        }

        private function getPostTitle(PostRequest $request): PostTitle
        {
            try {
                return new PostTitle($request->getParam('title'));
            } catch (\Exception $exception) {
                throw new BadRequest($exception->getMessage(), 'invalid_post_title', $exception);
            }
        }

        private function addAttachments(PostRequest $request, CreateModel $model)
        {
            if (!$request->hasParam('attachments')) {
                return;
            }

            if (!is_array($request->getParam('attachments'))) {
                throw new BadRequest('attachments must be an array', 'invalid_attachments');
            }

            foreach ($request->getParam('attachments') as $attachment) {
                $model->addPostAttachment(new Attachment($attachment));
            }
        }
    }
}
