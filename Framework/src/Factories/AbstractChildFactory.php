<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Factories
{
    abstract class AbstractChildFactory implements ChildFactoryInterface
    {
        /**
         * @var MasterFactoryInterface
         */
        private $masterFactory;

        public function setMasterFactory(MasterFactoryInterface $masterFactory)
        {
            $this->masterFactory = $masterFactory;
        }

        protected function getMasterFactory(): MasterFactoryInterface
        {
            return $this->masterFactory;
        }
    }
}
