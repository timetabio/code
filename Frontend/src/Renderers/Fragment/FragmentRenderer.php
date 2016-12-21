<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Fragment
{
    use Timetabio\Frontend\Models\FragmentModel;

    interface FragmentRenderer
    {
        public function render(FragmentModel $model): string;
    }
}
