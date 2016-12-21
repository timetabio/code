<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Get\Search
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Handlers\Get\ListRequestHandler;
    use Timetabio\API\Models\SearchModel;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Locators\SearchTypeLocator;

    class RequestHandler extends ListRequestHandler
    {
        /**
         * @var SearchTypeLocator
         */
        private $searchTypeLocator;

        public function __construct(SearchTypeLocator $searchTypeLocator)
        {
            $this->searchTypeLocator = $searchTypeLocator;
        }

        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var SearchModel $model */

            parent::execute($request, $model);

            if (!$request->hasQueryParam('query')) {
                throw new BadRequest('missing parameter \'query\'', 'missing_parameter');
            }

            $model->setQuery($request->getQueryParam('query'));

            if ($request->hasQueryParam('type')) {
                $type = $this->searchTypeLocator->locate($request->getQueryParam('type'));
                $model->setType($type);
            }
        }
    }
}
