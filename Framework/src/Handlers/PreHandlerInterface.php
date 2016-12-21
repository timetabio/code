<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Handlers
{
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    interface PreHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model);
    }
}
