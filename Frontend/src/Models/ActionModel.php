<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models
{
    class ActionModel extends FrontendModel
    {
        /**
         * @var array
         */
        private $data = [];

        public function getData(): array
        {
            return $this->data;
        }

        public function setData(array $data)
        {
            $this->data = $data;
        }
    }
}
