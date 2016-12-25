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
    use Timetabio\API\Models\APIModel;
    use Timetabio\Framework\Controllers\DeleteController;
    use Timetabio\Framework\Controllers\GetController;
    use Timetabio\Framework\Controllers\PatchController;
    use Timetabio\Framework\Controllers\PostController;
    use Timetabio\Framework\Controllers\PutController;
    use Timetabio\Framework\Factories\AbstractChildFactory;
    use Timetabio\Framework\Http\Response\JsonResponse;

    class ControllerFactory extends AbstractChildFactory
    {
        public function createGetIndexController(): GetController
        {
            return new GetController(
                new APIModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createGetIndexQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetProfileController(): GetController
        {
            return new GetController(
                new \Timetabio\API\Models\Profile\ProfileModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createGetProfileRequestHandler(),
                $this->getMasterFactory()->createGetProfileQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetRandomController(): GetController
        {
            return new GetController(
                new \Timetabio\API\Models\APIModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createGetRandomQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetFeedController(): GetController
        {
            return new GetController(
                new \Timetabio\API\Models\Feed\FeedModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createGetFeedRequestHandler(),
                $this->getMasterFactory()->createGetFeedQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetFeedsController(): GetController
        {
            return new GetController(
                new \Timetabio\API\Models\ListModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createListRequestHandler(),
                $this->getMasterFactory()->createGetFeedsQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetUserController(): GetController
        {
            return new GetController(
                new \Timetabio\API\Models\APIModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createGetUserQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetUserFeedsController(): GetController
        {
            return new GetController(
                new \Timetabio\API\Models\ListModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createListRequestHandler(),
                $this->getMasterFactory()->createGetUserFeedsQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createUpdateFeedController(): PatchController
        {
            return new PatchController(
                new \Timetabio\API\Models\Feed\UpdateModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createUpdateFeedRequestHandler(),
                $this->getMasterFactory()->createUpdateFeedQueryHandler(),
                $this->getMasterFactory()->createUpdateFeedCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createUpdateUserController(): PatchController
        {
            return new PatchController(
                new \Timetabio\API\Models\User\UpdateUserModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createUpdateUserRequestHandler(),
                $this->getMasterFactory()->createUpdateUserQueryHandler(),
                $this->getMasterFactory()->createUpdateUserCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createUpdateUserPasswordController(): PutController
        {
            return new PutController(
                new \Timetabio\API\Models\User\UpdateUserPasswordModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createUpdateUserPasswordRequestHandler(),
                $this->getMasterFactory()->createUpdateUserPasswordQueryHandler(),
                $this->getMasterFactory()->createUpdateUserPasswordCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createResetPasswordController(): PostController
        {
            return new PostController(
                new \Timetabio\API\Models\ResetPasswordModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createResetPasswordRequestHandler(),
                $this->getMasterFactory()->createResetPasswordQueryHandler(),
                $this->getMasterFactory()->createResetPasswordCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createForgotPasswordController(): PostController
        {
            return new PostController(
                new \Timetabio\API\Models\ForgotPasswordModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createForgotPasswordRequestHandler(),
                $this->getMasterFactory()->createForgotPasswordQueryHandler(),
                $this->getMasterFactory()->createForgotPasswordCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createAuthController(): PostController
        {
            return new PostController(
                new \Timetabio\API\Models\AuthModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createAuthRequestHandler(),
                $this->getMasterFactory()->createAuthQueryHandler(),
                $this->getMasterFactory()->createAuthCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetCollectionController(): GetController
        {
            return new GetController(
                new \Timetabio\API\Models\Collection\CollectionModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createGetCollectionRequestHandler(),
                $this->getMasterFactory()->createGetCollectionQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createDeleteCollectionController(): DeleteController
        {
            return new DeleteController(
                new \Timetabio\API\Models\Collection\CollectionModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createDeleteCollectionRequestHandler(),
                $this->getMasterFactory()->createDeleteCollectionQueryHandler(),
                $this->getMasterFactory()->createDeleteCollectionCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createUpdateCollectionController(): PatchController
        {
            return new PatchController(
                new \Timetabio\API\Models\Collection\UpdateModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createUpdateCollectionRequestHandler(),
                $this->getMasterFactory()->createUpdateCollectionQueryHandler(),
                $this->getMasterFactory()->createUpdateCollectionCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetUserCollectionsController(): GetController
        {
            return new GetController(
                new \Timetabio\API\Models\ListModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createListRequestHandler(),
                $this->getMasterFactory()->createGetUserCollectionsQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createFollowFeedController(): PostController
        {
            return new PostController(
                new \Timetabio\API\Models\Feed\FollowModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createFollowFeedRequestHandler(),
                $this->getMasterFactory()->createFollowFeedQueryHandler(),
                $this->getMasterFactory()->createFollowFeedCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createUnfollowFeedController(): PostController
        {
            return new PostController(
                new \Timetabio\API\Models\Feed\FollowModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createFollowFeedRequestHandler(),
                $this->getMasterFactory()->createUnfollowFeedQueryHandler(),
                $this->getMasterFactory()->createUnfollowFeedCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createCreateFeedController(): PostController
        {
            return new PostController(
                new \Timetabio\API\Models\Feed\CreateModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createCreateFeedRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createCreateFeedCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createCreateUserController(): PostController
        {
            return new PostController(
                new \Timetabio\API\Models\User\CreateModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createCreateUserRequestHandler(),
                $this->getMasterFactory()->createCreateUserQueryHandler(),
                $this->getMasterFactory()->createCreateUserCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createVerifyController(): PostController
        {
            return new PostController(
                new \Timetabio\API\Models\Verify\VerifyModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createVerifyRequestHandler(),
                $this->getMasterFactory()->createVerifyQueryHandler(),
                $this->getMasterFactory()->createVerifyCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createResendVerificationController(): PostController
        {
            return new PostController(
                new \Timetabio\API\Models\Verify\ResendModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createResendVerificationRequestHandler(),
                $this->getMasterFactory()->createResendVerificationQueryHandler(),
                $this->getMasterFactory()->createResendVerificationCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createCreateCollectionController(): PostController
        {
            return new PostController(
                new \Timetabio\API\Models\Collection\CreateModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createCreateCollectionRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createCreateCollectionCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createDeleteFeedPersonController(): DeleteController
        {
            return new DeleteController(
                new \Timetabio\API\Models\Feed\People\DeleteModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createDeleteFeedPeopleRequestHandler(),
                $this->getMasterFactory()->createDeleteFeedPeopleQueryHandler(),
                $this->getMasterFactory()->createDeleteFeedPeopleCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetFeedUsersController(): GetController
        {
            return new GetController(
                new \Timetabio\API\Models\Feed\People\ListModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createGetFeedPeopleRequestHandler(),
                $this->getMasterFactory()->createGetFeedPeopleQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createCreatePostController(): PostController
        {
            return new PostController(
                new \Timetabio\API\Models\Post\CreateModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createCreatePostRequestHandler(),
                $this->getMasterFactory()->createCreatePostQueryHandler(),
                $this->getMasterFactory()->createCreatePostCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetFeedPostsController(): GetController
        {
            return new GetController(
                new \Timetabio\API\Models\Feed\Posts\ListModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createGetFeedPostsRequestHandler(),
                $this->getMasterFactory()->createGetFeedPostsQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetPostController(): GetController
        {
            return new GetController(
                new \Timetabio\API\Models\Post\PostModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createGetPostRequestHandler(),
                $this->getMasterFactory()->createGetPostQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetUserUpcomingController(): GetController
        {
            return new GetController(
                new \Timetabio\API\Models\ListModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createListRequestHandler(),
                $this->getMasterFactory()->createGetUserUpcomingQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetUserTodoController(): GetController
        {
            return new GetController(
                new \Timetabio\API\Models\ListModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createListRequestHandler(),
                $this->getMasterFactory()->createGetUserTodoQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createDeletePostController(): DeleteController
        {
            return new DeleteController(
                new \Timetabio\API\Models\Post\PostModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createDeletePostRequestHandler(),
                $this->getMasterFactory()->createDeletePostQueryHandler(),
                $this->getMasterFactory()->createDeletePostCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createCreateFeedUploadUrlController(): DeleteController
        {
            return new DeleteController(
                new \Timetabio\API\Models\Feed\UploadModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createCreateFeedUploadRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createCreateFeedUploadCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createRevokeController(): PostController
        {
            return new PostController(
                new \Timetabio\API\Models\APIModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createRevokeCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createCreateBetaRequestController(): PostController
        {
            return new PostController(
                new \Timetabio\API\Models\BetaRequest\CreateModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createCreateBetaRequestRequestHandler(),
                $this->getMasterFactory()->createCreateBetaRequestQueryHandler(),
                $this->getMasterFactory()->createCreateBetaRequestCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createCreateFeedInvitationController(): PostController
        {
            return new PostController(
                new \Timetabio\API\Models\Feed\Invitation\CreateModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createCreateFeedInvitationRequestHandler(),
                $this->getMasterFactory()->createCreateFeedInvitationQueryHandler(),
                $this->getMasterFactory()->createCreateFeedInvitationCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetFeedInvitationsController(): GetController
        {
            return new GetController(
                new \Timetabio\API\Models\Feed\FeedModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createGetFeedRequestHandler(),
                $this->getMasterFactory()->createGetFeedInvitationsQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createUpdateFeedInvitationController(): PatchController
        {
            return new PatchController(
                new \Timetabio\API\Models\Feed\Invitation\UpdateModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createUpdateFeedInvitationRequestHandler(),
                $this->getMasterFactory()->createUpdateFeedInvitationQueryHandler(),
                $this->getMasterFactory()->createUpdateFeedInvitationCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createDeleteFeedInvitationController(): DeleteController
        {
            return new DeleteController(
                new \Timetabio\API\Models\Feed\Invitation\DeleteModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createDeleteFeedInvitationRequestHandler(),
                $this->getMasterFactory()->createDeleteFeedInvitationQueryHandler(),
                $this->getMasterFactory()->createDeleteFeedInvitationCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createUpdateFeedUserController(): PatchController
        {
            return new PatchController(
                new \Timetabio\API\Models\Feed\User\UpdateModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createUpdateFeedUserRequestHandler(),
                $this->getMasterFactory()->createUpdateFeedUserQueryHandler(),
                $this->getMasterFactory()->createUpdateFeedUserCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createSearchController(): GetController
        {
            return new GetController(
                new \Timetabio\API\Models\SearchModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createSearchRequestHandler(),
                $this->getMasterFactory()->createSearchQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetUserFeedController(): GetController
        {
            return new GetController(
                new \Timetabio\API\Models\ListModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createListRequestHandler(),
                $this->getMasterFactory()->createGetUserFeedQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }
    }
}
