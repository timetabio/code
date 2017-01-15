<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class RouterFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        public function createEndpointRouter(): \Timetabio\API\Routers\EndpointRouter
        {
            $router = new \Timetabio\API\Routers\EndpointRouter(
                $this->getMasterFactory()->createAccessControl()
            );

            $router->registerEndpoint($this->getMasterFactory()->createGetIndexEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createCreateUserEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createAuthEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createVerifyEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createGetUserEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createUpdateUserPasswordEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createResetPasswordEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createForgotPasswordEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createUpdateUserEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createGetProfileEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createGetCollectionEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createCreateCollectionEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createCreateFeedEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createGetFeedsEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createGetUserFeedsEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createGetUserFeedsEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createGetFeedEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createUpdateFeedEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createFollowFeedEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createUnfollowFeedEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createGetRandomEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createResendVerificationEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createGetUserCollectionsEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createDeleteFeedUserEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createGetFeedUsersEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createCreatePostEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createDeletePostEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createGetPostEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createGetPostsEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createUpdatePostEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createUpdateCollectionEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createDeleteCollectionEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createGetUpcomingEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createGetUserTodoEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createCreateFeedUploadUrlEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createRevokeEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createCreateFeedInvitationEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createGetFeedInvitationsEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createUpdateFeedInvitationEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createDeleteFeedInvitationEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createUpdateFeedUserEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createSearchEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createGetUserFeedEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createArchivePostEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createRestorePostEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createUpdatePostBodyEndpoint());
            $router->registerEndpoint($this->getMasterFactory()->createUpdatePostTitleEndpoint());

            return $router;
        }
    }
}
