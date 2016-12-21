<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Transformations
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Library\Transformations\TransformationInterface;

    class Transformer implements TransformationInterface
    {
        /**
         * @var TransformationInterface[]
         */
        private $transformations;

        public function __construct(TransformationInterface ...$transformations)
        {
            $this->transformations = $transformations;
        }

        public function apply(PageModel $model, Document $template)
        {
            foreach ($this->transformations as $transformation) {
                $transformation->apply($model, $template);
            }
        }
    }
}
