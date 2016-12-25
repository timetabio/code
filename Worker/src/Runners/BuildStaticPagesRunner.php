<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Worker\Runners
{
    use Timetabio\Framework\Backends\FileBackend;
    use Timetabio\Framework\Languages\LanguageInterface;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\Builders\StaticPageBuilder;
    use Timetabio\Worker\DataStore\DataStoreWriter;

    class BuildStaticPagesRunner implements RunnerInterface
    {
        /**
         * @var FileBackend
         */
        private $fileBackend;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        /**
         * @var StaticPageBuilder
         */
        private $staticPageBuilder;

        public function __construct(
            FileBackend $fileBackend,
            DataStoreWriter $dataStoreWriter,
            StaticPageBuilder $staticPageBuilder
        )
        {
            $this->fileBackend = $fileBackend;
            $this->dataStoreWriter = $dataStoreWriter;
            $this->staticPageBuilder = $staticPageBuilder;
        }

        public function run(TaskInterface $task)
        {
            $routes = json_decode($this->fileBackend->read('dataDir://routes.json'), true);

            $this->dataStoreWriter->removeStaticRoutes();

            foreach ($routes as $route => $name) {
                $this->build($route, $name, new \Timetabio\Framework\Languages\English);
                // $this->build($route, $name, new \Timetabio\Framework\Languages\German);
            }
        }

        private function build(string $route, string $name, LanguageInterface $language)
        {
            $staticPage = $this->staticPageBuilder->build($name, $language);

            $this->dataStoreWriter->setStaticRoute($route, $name);
            $this->dataStoreWriter->setStaticPage($name, $language, $staticPage);
        }
    }
}
