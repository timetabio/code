<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Mappers
{
    use Timetabio\Framework\ValueObjects\StringDateTime;

    /**
     * @todo Rename to something more appropriate
     */
    class DocumentMapper
    {
        public function map(array $document): array
        {
            if (isset($document['created'])) {
                $document['created'] = (new StringDateTime($document['created']))->getTimestamp();
            }

            if (isset($document['updated'])) {
                $document['updated'] = (new StringDateTime($document['updated']))->getTimestamp();
            }

            return $document;
        }

        /**
         * @deprecated
         */
        public function listMap(array $documents): array
        {
            $result = [];

            foreach ($documents as $document) {
                $result[] = $this->map($document);
            }

            return $result;
        }
    }
}
