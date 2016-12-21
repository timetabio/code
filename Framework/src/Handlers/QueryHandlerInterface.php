<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Handlers
{
    use Timetabio\Framework\Models\AbstractModel;

    interface QueryHandlerInterface
    {
        public function execute(AbstractModel $model);
    }
}
