<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers
{
    use Timetabio\Framework\Handlers\PreHandlerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class PreHandler implements PreHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            // TODO: Implement execute() method.
        }
    }
}
