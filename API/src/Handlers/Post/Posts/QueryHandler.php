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
    use Timetabio\API\Access\AccessControl\FeedAccessControl;
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Exceptions\Forbidden;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Models\Post\CreateModel;
    use Timetabio\API\Queries\File\FetchFileByPublicIdQuery;
    use Timetabio\API\ValueObjects\Attachment;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FeedAccessControl
         */
        private $accessControl;

        /**
         * @var FetchFileByPublicIdQuery
         */
        private $fetchFileByPublicIdQuery;

        public function __construct(FeedAccessControl $accessControl, FetchFileByPublicIdQuery $fetchFileByPathQuery)
        {
            $this->accessControl = $accessControl;
            $this->fetchFileByPublicIdQuery = $fetchFileByPathQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var CreateModel $model */

            $feedId = $model->getFeedId();
            $accessToken = $model->getAccessToken();

            if (!$this->accessControl->hasReadAccess($feedId, $accessToken)) {
                throw new NotFound('feed not found', 'not_found');
            }

            if (!$this->accessControl->hasPostAccess($feedId, $accessToken)) {
                throw new Forbidden('access denied', 'access_denied');
            }

            /** @var Attachment $attachment */
            foreach ($model->getPostAttachments() as $attachment) {
                $publicId = $attachment->getPublicId();
                $file = $this->fetchFileByPublicIdQuery->execute($publicId);

                if ($file === null) {
                    throw new BadRequest('file \'' . $publicId . '\' not found', 'file_not_found');
                }

                $attachment->setFileId($file['id']);
            }
        }
    }
}
