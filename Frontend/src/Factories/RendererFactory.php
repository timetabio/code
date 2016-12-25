<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;
    use Timetabio\Frontend\Renderers;

    class RendererFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        public function createStaticPageRenderer(): \Timetabio\Frontend\Renderers\Renderer
        {
            return new \Timetabio\Frontend\Renderers\PageRenderer(
                $this->getTemplate(),
                $this->getMasterFactory()->createStaticPageContentRenderer(),
                $this->getMasterFactory()->createTransformer()
            );
        }

        public function createStaticPageContentRenderer(): \Timetabio\Frontend\Renderers\Page\StaticPageRenderer
        {
            return new \Timetabio\Frontend\Renderers\Page\StaticPageRenderer(
                $this->getMasterFactory()->createDomBackend(),
                $this->getMasterFactory()->createGettext()
            );
        }

        public function createVerifyAccountPageRenderer(): \Timetabio\Frontend\Renderers\Renderer
        {
            return new \Timetabio\Frontend\Renderers\PageRenderer(
                $this->getTemplate(),
                $this->getMasterFactory()->createVerifyAccountPageContentRenderer(),
                $this->getMasterFactory()->createTransformer()
            );
        }

        public function createVerifyAccountPageContentRenderer(): \Timetabio\Frontend\Renderers\Page\Account\VerifyAccountPageRenderer
        {
            return new \Timetabio\Frontend\Renderers\Page\Account\VerifyAccountPageRenderer(
                $this->getMasterFactory()->createDomBackend()
            );
        }

        public function createHomepageRenderer(): \Timetabio\Frontend\Renderers\Renderer
        {
            return new \Timetabio\Frontend\Renderers\PageRenderer(
                $this->getTemplate(),
                $this->getMasterFactory()->createHomepageContentRenderer(),
                $this->getMasterFactory()->createTransformer()
            );
        }

        public function createHomepageContentRenderer(): \Timetabio\Frontend\Renderers\Page\HomepageRenderer
        {
            return new \Timetabio\Frontend\Renderers\Page\HomepageRenderer(
                $this->getMasterFactory()->createPostSnippet(),
                $this->getMasterFactory()->createPaginationButtonSnippet(),
                $this->getMasterFactory()->createHomepageNavigationSnippet(),
                $this->getMasterFactory()->createHomepageOnboardingSnippet()
            );
        }

        public function createFeedsPageRenderer(): \Timetabio\Frontend\Renderers\Renderer
        {
            return new \Timetabio\Frontend\Renderers\PageRenderer(
                $this->getTemplate(),
                $this->getMasterFactory()->createFeedsPageContentRenderer(),
                $this->getMasterFactory()->createTransformer()
            );
        }

        public function createFeedsPageContentRenderer(): \Timetabio\Frontend\Renderers\Page\FeedsPageRenderer
        {
            return new \Timetabio\Frontend\Renderers\Page\FeedsPageRenderer(
                $this->getMasterFactory()->createFeedCardSnippet(),
                $this->getMasterFactory()->createPaginationButtonSnippet(),
                $this->getMasterFactory()->createHomepageNavigationSnippet(),
                $this->getMasterFactory()->createHomepageOnboardingSnippet(),
                $this->getMasterFactory()->createFloatingButtonSnippet()
            );
        }

        public function createFeedPageRenderer(): \Timetabio\Frontend\Renderers\Renderer
        {
            return new \Timetabio\Frontend\Renderers\FeedPageRenderer(
                $this->getTemplate(),
                $this->getMasterFactory()->createFeedPageContentRenderer(),
                $this->getMasterFactory()->createTransformer(),
                $this->getMasterFactory()->createFeedHeaderSnippet(),
                $this->getMasterFactory()->createFeedButtonsSnippet(),
                $this->getMasterFactory()->createFeedInvitationBannerSnippet(),
                $this->getMasterFactory()->createFeedNavigationSnippet()
            );
        }

        public function createFeedPageContentRenderer(): \Timetabio\Frontend\Renderers\Page\FeedPageRenderer
        {
            return new \Timetabio\Frontend\Renderers\Page\FeedPageRenderer(
                $this->getMasterFactory()->createPostSnippet(),
                $this->getMasterFactory()->createPaginationButtonSnippet()
            );
        }

        public function createPostPageRenderer(): \Timetabio\Frontend\Renderers\Renderer
        {
            return new \Timetabio\Frontend\Renderers\PageRenderer(
                $this->getTemplate(),
                $this->getMasterFactory()->createPostPageContentRenderer(),
                $this->getMasterFactory()->createTransformer()
            );
        }

        public function createPostPageContentRenderer(): \Timetabio\Frontend\Renderers\Page\PostPageRenderer
        {
            return new \Timetabio\Frontend\Renderers\Page\PostPageRenderer(
                $this->getMasterFactory()->createPostSnippet()
            );
        }

        public function createCreatePostPageRenderer(): \Timetabio\Frontend\Renderers\Renderer
        {
            return new \Timetabio\Frontend\Renderers\PageRenderer(
                $this->getTemplate(),
                $this->getMasterFactory()->createCreatePostPageContentRenderer(),
                $this->getMasterFactory()->createTransformer()
            );
        }

        public function createCreatePostPageContentRenderer(): \Timetabio\Frontend\Renderers\Page\CreatePostPageRenderer
        {
            return new \Timetabio\Frontend\Renderers\Page\CreatePostPageRenderer(
                $this->getMasterFactory()->createFeedButtonsSnippet(),
                $this->getMasterFactory()->createIconSnippet(),
                $this->getMasterFactory()->createUriBuilder()
            );
        }

        public function createSearchPageRenderer(): \Timetabio\Frontend\Renderers\Renderer
        {
            return new \Timetabio\Frontend\Renderers\PageRenderer(
                $this->getTemplate(),
                $this->getMasterFactory()->createSearchPageContentRenderer(),
                $this->getMasterFactory()->createTransformer()
            );
        }

        public function createSearchPageContentRenderer(): \Timetabio\Frontend\Renderers\Page\SearchPageRenderer
        {
            return new \Timetabio\Frontend\Renderers\Page\SearchPageRenderer(
                $this->getMasterFactory()->createPostSnippet(),
                $this->getMasterFactory()->createFeedCardSnippet(),
                $this->getMasterFactory()->createSearchTabNavSnippet()
            );
        }

        public function createFeedPeoplePageRenderer(): \Timetabio\Frontend\Renderers\Renderer
        {
            return new \Timetabio\Frontend\Renderers\FeedPageRenderer(
                $this->getTemplate(),
                $this->getMasterFactory()->createFeedPeoplePageContentRenderer(),
                $this->getMasterFactory()->createTransformer(),
                $this->getMasterFactory()->createFeedHeaderSnippet(),
                $this->getMasterFactory()->createFeedButtonsSnippet(),
                $this->getMasterFactory()->createFeedInvitationBannerSnippet(),
                $this->getMasterFactory()->createFeedNavigationSnippet()
            );
        }

        public function createFeedPeoplePageContentRenderer(): \Timetabio\Frontend\Renderers\Page\Feed\FeedPeoplePageRenderer
        {
            return new \Timetabio\Frontend\Renderers\Page\Feed\FeedPeoplePageRenderer(
                $this->getMasterFactory()->createUserRolesOptionsSnippet(),
                $this->getMasterFactory()->createFeedUserCardSnippet(),
                $this->getMasterFactory()->createFeedInvitationCardSnippet(),
                $this->getMasterFactory()->createIconButtonSnippet()
            );
        }

        public function createFeedSettingsPageRenderer(): \Timetabio\Frontend\Renderers\Renderer
        {
            return new \Timetabio\Frontend\Renderers\FeedPageRenderer(
                $this->getTemplate(),
                $this->getMasterFactory()->createFeedSettingsPageContentRenderer(),
                $this->getMasterFactory()->createTransformer(),
                $this->getMasterFactory()->createFeedHeaderSnippet(),
                $this->getMasterFactory()->createFeedButtonsSnippet(),
                $this->getMasterFactory()->createFeedInvitationBannerSnippet(),
                $this->getMasterFactory()->createFeedNavigationSnippet()
            );
        }

        public function createFeedSettingsPageContentRenderer(): \Timetabio\Frontend\Renderers\Page\Feed\FeedSettingsPageRenderer
        {
            return new \Timetabio\Frontend\Renderers\Page\Feed\FeedSettingsPageRenderer(
                $this->getMasterFactory()->createIconButtonSnippet()
            );
        }

        public function createFeedListSnippet(): \Timetabio\Frontend\Renderers\Snippet\FeedListSnippet
        {
            return new \Timetabio\Frontend\Renderers\Snippet\FeedListSnippet(
                $this->getMasterFactory()->createUriBuilder()
            );
        }

        public function createFeedHeaderSnippet(): \Timetabio\Frontend\Renderers\Snippet\FeedHeaderSnippet
        {
            return new \Timetabio\Frontend\Renderers\Snippet\FeedHeaderSnippet(
                $this->getMasterFactory()->createIconSnippet()
            );
        }

        public function createPostSnippet(): \Timetabio\Frontend\Renderers\Snippet\PostSnippet
        {
            return new \Timetabio\Frontend\Renderers\Snippet\PostSnippet(
                $this->getMasterFactory()->createIconSnippet(),
                $this->getMasterFactory()->createUriBuilder(),
                $this->getMasterFactory()->createPostAttachmentSnippet()
            );
        }

        public function createPostAttachmentSnippet(): \Timetabio\Frontend\Renderers\Snippet\PostAttachmentSnippet
        {
            return new \Timetabio\Frontend\Renderers\Snippet\PostAttachmentSnippet(
                $this->getMasterFactory()->createIconSnippet()
            );
        }

        public function createFeedButtonsSnippet(): \Timetabio\Frontend\Renderers\Snippet\FeedButtonsSnippet
        {
            return new \Timetabio\Frontend\Renderers\Snippet\FeedButtonsSnippet(
                $this->getMasterFactory()->createFloatingButtonSnippet(),
                $this->getMasterFactory()->createUriBuilder()
            );
        }

        public function createIconSnippet(): \Timetabio\Frontend\Renderers\Snippet\IconSnippet
        {
            return new \Timetabio\Frontend\Renderers\Snippet\IconSnippet;
        }

        public function createFeedInvitationBannerSnippet(): \Timetabio\Frontend\Renderers\Snippet\FeedInvitationBannerSnippet
        {
            return new \Timetabio\Frontend\Renderers\Snippet\FeedInvitationBannerSnippet;
        }

        public function createTabNavSnippet(): \Timetabio\Frontend\Renderers\Snippet\TabNavSnippet
        {
            return new \Timetabio\Frontend\Renderers\Snippet\TabNavSnippet(
                $this->getMasterFactory()->createIconSnippet()
            );
        }

        public function createFeedCardSnippet(): \Timetabio\Frontend\Renderers\Snippet\FeedCardSnippet
        {
            return new \Timetabio\Frontend\Renderers\Snippet\FeedCardSnippet(
                $this->getMasterFactory()->createUriBuilder(),
                $this->getMasterFactory()->createIconSnippet()
            );
        }

        public function createFeedPostsFragmentRenderer(): \Timetabio\Frontend\Renderers\Fragment\FeedPostsFragmentRenderer
        {
            return new \Timetabio\Frontend\Renderers\Fragment\FeedPostsFragmentRenderer(
                $this->getMasterFactory()->createPostSnippet()
            );
        }

        public function createHomepagePostsFragmentRenderer(): \Timetabio\Frontend\Renderers\Fragment\HomepagePostsFragmentRenderer
        {
            return new \Timetabio\Frontend\Renderers\Fragment\HomepagePostsFragmentRenderer(
                $this->getMasterFactory()->createPostSnippet()
            );
        }

        public function createPaginationButtonSnippet(): \Timetabio\Frontend\Renderers\Snippet\PaginationButtonSnippet
        {
            return new \Timetabio\Frontend\Renderers\Snippet\PaginationButtonSnippet;
        }

        public function createFeedNavigationSnippet(): \Timetabio\Frontend\Renderers\Snippet\FeedNavigationSnippet
        {
            return new \Timetabio\Frontend\Renderers\Snippet\FeedNavigationSnippet(
                $this->getMasterFactory()->createTabNavSnippet(),
                $this->getMasterFactory()->createUriBuilder()
            );
        }

        public function createUserRolesOptionsSnippet(): Renderers\Snippet\UserRolesOptionsSnippet
        {
            return new Renderers\Snippet\UserRolesOptionsSnippet;
        }

        public function createAjaxButtonSnippet(): Renderers\Snippet\AjaxButtonSnippet
        {
            return new Renderers\Snippet\AjaxButtonSnippet;
        }

        public function createFeedUserCardSnippet(): Renderers\Snippet\FeedUserCardSnippet
        {
            return new Renderers\Snippet\FeedUserCardSnippet(
                $this->getMasterFactory()->createIconButtonSnippet(),
                $this->getMasterFactory()->createUserRolesOptionsSnippet(),
                $this->getMasterFactory()->createAjaxButtonSnippet(),
                $this->getMasterFactory()->createUserRoleLocator()
            );
        }

        public function createIconButtonSnippet(): Renderers\Snippet\IconButtonSnippet
        {
            return new Renderers\Snippet\IconButtonSnippet(
                $this->getMasterFactory()->createIconSnippet()
            );
        }

        public function createFeedInvitationCardSnippet(): Renderers\Snippet\FeedInvitationCardSnippet
        {
            return new Renderers\Snippet\FeedInvitationCardSnippet(
                $this->getMasterFactory()->createIconButtonSnippet(),
                $this->getMasterFactory()->createAjaxButtonSnippet(),
                $this->getMasterFactory()->createUserRoleLocator()
            );
        }

        public function createSearchTabNavSnippet(): Renderers\Snippet\SearchTabNavSnippet
        {
            return new Renderers\Snippet\SearchTabNavSnippet(
                $this->getMasterFactory()->createTabNavSnippet(),
                $this->getMasterFactory()->createUriBuilder()
            );
        }

        public function createHomepageNavigationSnippet(): Renderers\Snippet\HomepageNavigationSnippet
        {
            return new Renderers\Snippet\HomepageNavigationSnippet(
                $this->getMasterFactory()->createTabNavSnippet()
            );
        }

        public function createHomepageOnboardingSnippet(): Renderers\Snippet\HomepageOnboardingSnippet
        {
            return new Renderers\Snippet\HomepageOnboardingSnippet;
        }

        public function createFloatingButtonSnippet(): Renderers\Snippet\FloatingButtonSnippet
        {
            return new Renderers\Snippet\FloatingButtonSnippet(
                $this->getMasterFactory()->createIconSnippet()
            );
        }

        protected function getTemplate(): \Timetabio\Framework\Dom\Document
        {
            return $this->getMasterFactory()->createDomBackend()->loadHtml(
                'templates://template.html'
            );
        }
    }
}
