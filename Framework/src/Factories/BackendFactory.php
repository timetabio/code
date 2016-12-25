<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Factories
{
    use Timetabio\Framework\Backends\PostgresBackend;

    class BackendFactory extends AbstractChildFactory
    {
        /**
         * @var PostgresBackend
         */
        private $postgresBackend;

        public function createFileBackend(): \Timetabio\Framework\Backends\FileBackend
        {
            return new \Timetabio\Framework\Backends\FileBackend;
        }

        public function createMailgunBackend(): \Timetabio\Framework\Backends\MailgunBackend
        {
            return new \Timetabio\Framework\Backends\MailgunBackend(
                $this->getMasterFactory()->createCurl(),
                $this->getMasterFactory()->getConfiguration()->get('mailgunEndpoint'),
                $this->getMasterFactory()->getConfiguration()->get('mailgunApiKey'),
                $this->getMasterFactory()->getConfiguration()->get('mailSender')
            );
        }

        public function createPostgresBackend(): \Timetabio\Framework\Backends\PostgresBackend
        {
            if ($this->postgresBackend === null) {
                $config = $this->getMasterFactory()->getConfiguration();
                $pdo = new \PDO($config->get('postgresDsn'));

                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                $this->postgresBackend = new \Timetabio\Framework\Backends\PostgresBackend($pdo);
            }

            return $this->postgresBackend;
        }

        public function createDomBackend(): \Timetabio\Framework\Backends\DomBackend
        {
            return new \Timetabio\Framework\Backends\DomBackend(
                $this->getMasterFactory()->createFileBackend()
            );
        }

        public function createAwsS3Backend(): \Timetabio\Framework\Backends\AwsS3Backend
        {
            $config = $this->getMasterFactory()->getConfiguration();

            return new \Timetabio\Framework\Backends\AwsS3Backend(
                $this->getMasterFactory()->createS3HelperUploadBuilder(),
                $this->getMasterFactory()->createS3HelperUriBuilder(),
                $config->get('s3MaxUploadSize')
            );
        }

        public function createAwsRestBackend(): \Timetabio\Framework\Backends\AwsRestBackend
        {
            return new \Timetabio\Framework\Backends\AwsRestBackend(
                $this->getMasterFactory()->createS3HelperRequestBuilder(),
                $this->getMasterFactory()->createCurl()
            );
        }

        public function createInkBackend(): \Timetabio\Framework\Backends\InkBackend
        {
            $factory = new \Ink\Factory;
            $options = new \Ink\Generators\Dom\GeneratorOptions;

            return new \Timetabio\Framework\Backends\InkBackend(
                $factory->createParser(),
                $factory->createDomGenerator($options),
                $factory->createPreviewTransformation(),
                $factory->createTextGenerator()
            );
        }

        public function createElasticBackend(): \Timetabio\Framework\Backends\ElasticBackend
        {
            $config = $this->getMasterFactory()->getConfiguration();

            $hosts = [
                $config->get('elasticHost')
            ];

            return new \Timetabio\Framework\Backends\ElasticBackend(
                \Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build(),
                $config->get('elasticIndex')
            );
        }
    }
}
