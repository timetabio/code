<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\TabNavItems
{
    use Timetabio\Frontend\Tabs\Tab;

    interface TabNavItem
    {
        public function getTab(): Tab;

        public function getUri(): string;

        public function getIcon(): string;

        public function getLabel(): string;
    }
}
