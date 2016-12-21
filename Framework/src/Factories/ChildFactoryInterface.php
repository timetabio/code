<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Factories
{
    interface ChildFactoryInterface
    {
        public function setMasterFactory(MasterFactoryInterface $masterFactory);
    }
}
