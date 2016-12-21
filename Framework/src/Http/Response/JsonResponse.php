<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Http\Response
{
    class JsonResponse extends AbstractResponse
    {
        protected function getContentType(): string
        {
            return 'application/json';
        }
    }
}
