<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Factories
{
    use Timetabio\Framework\Controllers\GetController;
    use Timetabio\Framework\Controllers\PostController;
    use Timetabio\Framework\Factories\AbstractChildFactory;
    use Timetabio\Framework\Http\Response\HtmlResponse;
    use Timetabio\Framework\Http\Response\JsonResponse;

    class ControllerFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        public function createStaticPageController(string $name, \Timetabio\Framework\Languages\LanguageInterface $language): GetController
        {
            return new GetController(
                new \Timetabio\Frontend\Models\StaticPageModel($name, $language),
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createGetStaticPageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createGetPageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createRegisterController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\RegisterModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createPostRegisterRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createPostRegisterCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createVerifyAccountPageController(): GetController
        {
            return new GetController(
                new \Timetabio\Frontend\Models\Account\VerifyModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createVerifyAccountPageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createLoginController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\LoginModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createLoginRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createLoginCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createResendVerificationController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\ResendVerificationModel(),
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createResendVerificationRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createResendVerificationCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createForgotController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\ForgotModel(),
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createForgotRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createForgotCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createLogoutController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\ActionModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createLogoutCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createHomepageController(): GetController
        {
            return new GetController(
                new \Timetabio\Frontend\Models\HomepageModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createGetHomepageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createGetHomepageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createFeedsPageController(): GetController
        {
            return new GetController(
                new \Timetabio\Frontend\Models\FeedsPageModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createFeedsPageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createFeedsPageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createNewFeedController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Account\NewFeedModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createNewFeedRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createNewFeedCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetFeedPageController(array $feed): GetController
        {
            return new GetController(
                new \Timetabio\Frontend\Models\Page\FeedPostsPageModel(
                    new \Timetabio\Frontend\ValueObjects\Feed($feed)
                ),
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createGetFeedPageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createGetFeedPageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createGetCreatePostPageController(array $feed): GetController
        {
            return new GetController(
                new \Timetabio\Frontend\Models\CreatePostPageModel($feed),
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createGetCreatePostPageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createGetCreatePostPageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createCreateNoteController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\CreateNoteModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createCreateNoteRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createCreateNoteCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createFollowController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\FollowModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createFollowRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createFollowCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createUnfollowController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\FollowModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createFollowRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createUnfollowCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createDeletePostController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\PostModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createDeletePostRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createDeletePostCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createRestorePostController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\PostModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createDeletePostRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createRestorePostCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createCreateUploadController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\UploadModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createCreateUploadRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createCreateUploadCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createGetPostPageController(array $post): GetController
        {
            return new GetController(
                new \Timetabio\Frontend\Models\PostPageModel($post),
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createGetPostPageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createGetPostPageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createCreateBetaRequestController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\CreateBetaRequestModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createCreateBetaRequestRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createCreateBetaRequestCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createSearchPageController(\Timetabio\Library\SearchTypes\SearchType $type): GetController
        {
            return new GetController(
                new \Timetabio\Frontend\Models\Page\SearchPageModel($type),
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createSearchPageRequestHandler(),
                $this->getMasterFactory()->createSearchPageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createSearchPageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createGetFeedPostsFragmentController(): GetController
        {
            return new GetController(
                new \Timetabio\Frontend\Models\Fragment\FeedPostsFragmentModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createGetFeedPostsFragmentRequestHandler(),
                $this->getMasterFactory()->createGetFeedPostsFragmentQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createGetFeedPostsFragmentTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createGetHomepagePostsFragmentController(): GetController
        {
            return new GetController(
                new \Timetabio\Frontend\Models\Fragment\HomepagePostsFragmentModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createGetHomepagePostsFragmentRequestHandler(),
                $this->getMasterFactory()->createGetHomepagePostsFragmentQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createGetHomepagePostsFragmentTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createGetFeedPeoplePageController(array $feed): GetController
        {
            return new GetController(
                new \Timetabio\Frontend\Models\Page\FeedPeoplePageModel(
                    new \Timetabio\Frontend\ValueObjects\Feed($feed)
                ),
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createGetFeedPeoplePageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createGetFeedPeoplePageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createFeedSettingsPageController(array $feed): GetController
        {
            return new GetController(
                new \Timetabio\Frontend\Models\Page\FeedSettingsPageModel(
                    new \Timetabio\Frontend\ValueObjects\Feed($feed)
                ),
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createFeedSettingsPageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createDeleteFeedUserController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\DeleteFeedUserModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createDeleteFeedUserRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createDeleteFeedUserCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createInviteFeedUserController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\InviteFeedUserModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createInviteFeedUserRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createInviteFeedUserCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createDeleteFeedInvitationController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\DeleteFeedUserModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createDeleteFeedInvitationRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createDeleteFeedInvitationCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createUpdateFeedUserRoleController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\UpdateFeedUserRoleModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createUpdateFeedUserRoleRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createUpdateFeedUserRoleCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createUpdateFeedNameController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\UpdateFeedNameModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createUpdateFeedNameRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createUpdateFeedNameCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createUpdateFeedDescriptionController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\UpdateFeedDescriptionModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createUpdateFeedDescriptionRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createUpdateFeedDescriptionCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }

        public function createUpdateFeedVanityController(): PostController
        {
            return new PostController(
                new \Timetabio\Frontend\Models\Action\UpdateFeedVanityModel,
                $this->getMasterFactory()->createPreHandler(),
                $this->getMasterFactory()->createUpdateFeedVanityRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createUpdateFeedVanityCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new JsonResponse
            );
        }
    }
}
