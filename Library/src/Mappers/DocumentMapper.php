<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
