<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Factories
{
    use Timetabio\Framework\Factories\MasterFactoryInterface;

    trait FactoryTypeHintTrait
    {
        /**
         * @return FactoryTypeHint
         */
        abstract public function getMasterFactory(): MasterFactoryInterface;
    }
}
