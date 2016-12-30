<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\UpdateFeedVanity
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Commands\Feed\UpdateFeedVanityCommand;
    use Timetabio\Frontend\Exceptions\ApiException;
    use Timetabio\Frontend\Models\Action\UpdateFeedVanityModel;
    use Timetabio\Library\Builders\UriBuilder;

    class CommandHandler implements CommandHandlerInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var UpdateFeedVanityCommand
         */
        private $updateFeedVanityCommand;

        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(UpdateFeedVanityCommand $updateFeedVanityCommand, UriBuilder $uriBuilder)
        {
            $this->updateFeedVanityCommand = $updateFeedVanityCommand;
            $this->uriBuilder = $uriBuilder;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateFeedVanityModel $model */

            try {
                $this->updateFeedVanityCommand->execute(
                    $model->getFeedId(),
                    $model->getFeedVanity()
                );
            } catch (ApiException $exception) {
                return $model->setData([
                    'error' => $this->translator->translate($exception)
                ]);
            }

            $model->setData([
                'redirect' => $this->uriBuilder->buildFeedSettingsPageUri($model->getFeedId())
            ]);
        }
    }
}
