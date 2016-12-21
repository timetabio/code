<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Http\Response
{
    class HtmlResponse extends AbstractResponse
    {
        protected function getContentType(): string
        {
            return 'text/html';
        }
    }
}
