<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Get\PostPage
{
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Models\PostPageModel;

    class QueryHandler implements QueryHandlerInterface
    {
        public function execute(AbstractModel $model)
        {
            /** @var PostPageModel $model */

            $post = $model->getPost();

            if (isset($post['title'])) {
                $model->setTitle($post['title']);
            }
        }
    }
}
