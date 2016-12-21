<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers
{
    use Timetabio\Framework\Models\AbstractModel;

    interface Renderer
    {
        public function render(AbstractModel $model): string;
    }
}
