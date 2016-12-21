<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Transformations
{
    use Timetabio\Framework\Dom\Document;

    interface TransformationInterface
    {
        public function apply(Document $template);
    }
}
