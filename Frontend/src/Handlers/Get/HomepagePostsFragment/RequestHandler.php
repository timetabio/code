<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Get\HomepagePostsFragment
{
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Models\Fragment\HomepagePostsFragmentModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var HomepagePostsFragmentModel $model */

            try {
                $limit = (int) $request->getQueryParam('limit');
            } catch (\Throwable $exception) {
                $limit = 20;
            }

            try {
                $page = (int) $request->getQueryParam('page');
            } catch (\Throwable $exception) {
                $page = 1;
            }

            $model->setLimit($limit);
            $model->setPage($page);
        }
    }
}
