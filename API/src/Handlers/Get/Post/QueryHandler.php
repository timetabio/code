<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Get\Post
{
    use Timetabio\API\Access\AccessControl\FeedAccessControl;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Mappers\PostAttachmentMapper;
    use Timetabio\API\Models\Post\PostModel;
    use Timetabio\API\Queries\Post\FetchPostAttachmentsQuery;
    use Timetabio\API\Queries\Posts\FetchPostQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Mappers\PostMapper;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchPostQuery
         */
        private $fetchPostQuery;

        /**
         * @var FetchPostAttachmentsQuery
         */
        private $fetchPostAttachmentsQuery;

        /**
         * @var PostMapper
         */
        private $postMapper;

        /**
         * @var PostAttachmentMapper
         */
        private $postAttachmentMapper;

        /**
         * @var FeedAccessControl
         */
        private $accessControl;

        public function __construct(FetchPostQuery $fetchPostQuery, FetchPostAttachmentsQuery $fetchPostAttachmentsQuery, PostMapper $postMapper, PostAttachmentMapper $postAttachmentMapper, FeedAccessControl $accessControl)
        {
            $this->fetchPostQuery = $fetchPostQuery;
            $this->fetchPostAttachmentsQuery = $fetchPostAttachmentsQuery;
            $this->postMapper = $postMapper;
            $this->postAttachmentMapper = $postAttachmentMapper;
            $this->accessControl = $accessControl;
        }

        public function execute(AbstractModel $model)
        {
            /** @var PostModel $model */

            $userId = null;
            $token = null;

            if ($model->hasAuthUserId()) {
                $userId = $model->getAuthUserId();
            }

            if ($model->hasAccessToken()) {
                $token = $model->getAccessToken();
            }

            $post = $this->fetchPostQuery->execute($model->getPostId(), $userId);

            if ($post === null || !$this->accessControl->hasReadAccess($post['feed_id'], $token)) {
                throw new NotFound('post not found', 'not_found');
            }

            $attachments = $this->fetchPostAttachmentsQuery->execute($model->getPostId());

            foreach ($attachments as $i => $attachment) {
                $attachments[$i] = $this->postAttachmentMapper->map($attachment);
            }

            $post['attachments'] = $attachments;
            $post['feed']['access']['post'] = $this->accessControl->hasPostAccess($post['feed_id'], $token);

            $model->setData($this->postMapper->map($post));
        }
    }
}
