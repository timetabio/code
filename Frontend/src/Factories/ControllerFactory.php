<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;
    use Timetabio\Framework\Http\Response\HtmlResponse;
    use Timetabio\Framework\Languages\LanguageInterface;
    use Timetabio\Library\SearchTypes\SearchType;

    class ControllerFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        public function createStaticPageController(string $name, LanguageInterface $language): \Timetabio\Framework\Controllers\GetController
        {
            return new \Timetabio\Framework\Controllers\GetController(
                new \Timetabio\Frontend\Models\StaticPageModel($name, $language),
                $this->getMasterFactory()->createGetPagePreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createGetStaticPageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createGetPageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createRegisterController(): \Timetabio\Framework\Controllers\PostController
        {
            return new \Timetabio\Framework\Controllers\PostController(
                new \Timetabio\Frontend\Models\Action\RegisterModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createPostRegisterRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createPostRegisterCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createVerifyAccountController(): \Timetabio\Framework\Controllers\GetController
        {
            return new \Timetabio\Framework\Controllers\GetController(
                new \Timetabio\Frontend\Models\Account\VerifyModel,
                $this->getMasterFactory()->createGetPagePreHandler(),
                $this->getMasterFactory()->createGetVerifyAccountRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createGetVerifyAccountCommandHandler(),
                $this->getMasterFactory()->createGetVerifyAccountTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createLoginController(): \Timetabio\Framework\Controllers\PostController
        {
            return new \Timetabio\Framework\Controllers\PostController(
                new \Timetabio\Frontend\Models\Action\LoginModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createLoginRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createLoginCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createResendVerificationController(): \Timetabio\Framework\Controllers\PostController
        {
            return new \Timetabio\Framework\Controllers\PostController(
                new \Timetabio\Frontend\Models\Action\ResendVerificationModel(),
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createResendVerificationRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createResendVerificationCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createLogoutController(): \Timetabio\Framework\Controllers\PostController
        {
            return new \Timetabio\Framework\Controllers\PostController(
                new \Timetabio\Frontend\Models\ActionModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createLogoutCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createHomepageController(): \Timetabio\Framework\Controllers\GetController
        {
            return new \Timetabio\Framework\Controllers\GetController(
                new \Timetabio\Frontend\Models\HomepageModel,
                $this->getMasterFactory()->createGetPagePreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createGetHomepageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createGetHomepageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createFeedsPageController(): \Timetabio\Framework\Controllers\GetController
        {
            return new \Timetabio\Framework\Controllers\GetController(
                new \Timetabio\Frontend\Models\FeedsPageModel,
                $this->getMasterFactory()->createGetPagePreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createFeedsPageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createFeedsPageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createNewFeedController(): \Timetabio\Framework\Controllers\PostController
        {
            return new \Timetabio\Framework\Controllers\PostController(
                new \Timetabio\Frontend\Models\Account\NewFeedModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createNewFeedRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createNewFeedCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createGetFeedPageController(array $feed): \Timetabio\Framework\Controllers\GetController
        {
            return new \Timetabio\Framework\Controllers\GetController(
                new \Timetabio\Frontend\Models\Page\FeedPostsPageModel(
                    new \Timetabio\Frontend\ValueObjects\Feed($feed)
                ),
                $this->getMasterFactory()->createGetPagePreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createGetFeedPageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createGetFeedPageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createGetCreatePostPageController(array $feed): \Timetabio\Framework\Controllers\GetController
        {
            return new \Timetabio\Framework\Controllers\GetController(
                new \Timetabio\Frontend\Models\CreatePostPageModel($feed),
                $this->getMasterFactory()->createGetPagePreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createGetCreatePostPageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createGetCreatePostPageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createCreateNoteController(): \Timetabio\Framework\Controllers\PostController
        {
            return new \Timetabio\Framework\Controllers\PostController(
                new \Timetabio\Frontend\Models\Action\CreateNoteModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createCreateNoteRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createCreateNoteCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createFollowController(): \Timetabio\Framework\Controllers\PostController
        {
            return new \Timetabio\Framework\Controllers\PostController(
                new \Timetabio\Frontend\Models\Action\FollowModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createFollowRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createFollowCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createUnfollowController(): \Timetabio\Framework\Controllers\PostController
        {
            return new \Timetabio\Framework\Controllers\PostController(
                new \Timetabio\Frontend\Models\Action\FollowModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createFollowRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createUnfollowCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createDeletePostController(): \Timetabio\Framework\Controllers\PostController
        {
            return new \Timetabio\Framework\Controllers\PostController(
                new \Timetabio\Frontend\Models\Action\DeletePostModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createDeletePostRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createDeletePostCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createCreateUploadController(): \Timetabio\Framework\Controllers\PostController
        {
            return new \Timetabio\Framework\Controllers\PostController(
                new \Timetabio\Frontend\Models\Action\UploadModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createCreateUploadRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createCreateUploadCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createGetPostPageController(array $post): \Timetabio\Framework\Controllers\GetController
        {
            return new \Timetabio\Framework\Controllers\GetController(
                new \Timetabio\Frontend\Models\PostPageModel($post),
                $this->getMasterFactory()->createGetPagePreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createGetPostPageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createGetPostPageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createCreateBetaRequestController(): \Timetabio\Framework\Controllers\PostController
        {
            return new \Timetabio\Framework\Controllers\PostController(
                new \Timetabio\Frontend\Models\Action\CreateBetaRequestModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createCreateBetaRequestRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createCreateBetaRequestCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createSearchPageController(SearchType $type): \Timetabio\Framework\Controllers\GetController
        {
            return new \Timetabio\Framework\Controllers\GetController(
                new \Timetabio\Frontend\Models\Page\SearchPageModel($type),
                $this->getMasterFactory()->createGetPagePreHandler(),
                $this->getMasterFactory()->createSearchPageRequestHandler(),
                $this->getMasterFactory()->createSearchPageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createSearchPageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createGetFeedPostsFragmentController(): \Timetabio\Framework\Controllers\GetController
        {
            return new \Timetabio\Framework\Controllers\GetController(
                new \Timetabio\Frontend\Models\Fragment\FeedPostsFragmentModel,
                $this->getMasterFactory()->createGetPagePreHandler(),
                $this->getMasterFactory()->createGetFeedPostsFragmentRequestHandler(),
                $this->getMasterFactory()->createGetFeedPostsFragmentQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createGetFeedPostsFragmentTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createGetHomepagePostsFragmentController(): \Timetabio\Framework\Controllers\GetController
        {
            return new \Timetabio\Framework\Controllers\GetController(
                new \Timetabio\Frontend\Models\Fragment\HomepagePostsFragmentModel,
                $this->getMasterFactory()->createGetPagePreHandler(),
                $this->getMasterFactory()->createGetHomepagePostsFragmentRequestHandler(),
                $this->getMasterFactory()->createGetHomepagePostsFragmentQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createGetHomepagePostsFragmentTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createGetFeedPeoplePageController(array $feed): \Timetabio\Framework\Controllers\GetController
        {
            return new \Timetabio\Framework\Controllers\GetController(
                new \Timetabio\Frontend\Models\Page\FeedPeoplePageModel(
                    new \Timetabio\Frontend\ValueObjects\Feed($feed)
                ),
                $this->getMasterFactory()->createGetPagePreHandler(),
                $this->getMasterFactory()->createGetFeedPeoplePageRequestHandler(),
                $this->getMasterFactory()->createGetFeedPeoplePageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createGetFeedPeoplePageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createDeleteFeedUserController(): \Timetabio\Framework\Controllers\PostController
        {
            return new \Timetabio\Framework\Controllers\PostController(
                new \Timetabio\Frontend\Models\Action\DeleteFeedUserModel,
                $this->getMasterFactory()->createGetPagePreHandler(),
                $this->getMasterFactory()->createDeleteFeedUserRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createDeleteFeedUserCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createInviteFeedUserController(): \Timetabio\Framework\Controllers\PostController
        {
            return new \Timetabio\Framework\Controllers\PostController(
                new \Timetabio\Frontend\Models\Action\InviteFeedUserModel,
                $this->getMasterFactory()->createGetPagePreHandler(),
                $this->getMasterFactory()->createInviteFeedUserRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createInviteFeedUserCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createDeleteFeedInvitationController(): \Timetabio\Framework\Controllers\PostController
        {
            return new \Timetabio\Framework\Controllers\PostController(
                new \Timetabio\Frontend\Models\Action\DeleteFeedUserModel,
                $this->getMasterFactory()->createGetPagePreHandler(),
                $this->getMasterFactory()->createDeleteFeedInvitationRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createDeleteFeedInvitationCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createUpdateFeedUserRoleController(): \Timetabio\Framework\Controllers\PostController
        {
            return new \Timetabio\Framework\Controllers\PostController(
                new \Timetabio\Frontend\Models\Action\UpdateFeedUserRoleModel,
                $this->getMasterFactory()->createGetPagePreHandler(),
                $this->getMasterFactory()->createUpdateFeedUserRoleRequestHandler(),
                $this->getMasterFactory()->createQueryHandler(),
                $this->getMasterFactory()->createUpdateFeedUserRoleCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }
    }
}
