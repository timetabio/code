<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Mappers
{
    use Timetabio\API\Builders\UriBuilder;

    class PostAttachmentMapper
    {
        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(UriBuilder $uriBuilder)
        {
            $this->uriBuilder = $uriBuilder;
        }

        public function map(array $attachment): array
        {
            $mapped = [];

            if (isset($attachment['filename'])) {
                $mapped['filename'] = $attachment['filename'];
            }

            if (isset($attachment['mime_type'])) {
                $mapped['mime_type'] = $attachment['mime_type'];
            }

            if (isset($attachment['public_id']) && isset($attachment['filename'])) {
                $mapped['url'] = $this->uriBuilder->buildFileUri($attachment['public_id'], $attachment['filename']);
            }

            return $mapped;
        }
    }
}
