<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Post
{
    use Timetabio\Framework\Handlers\TransformationHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Models\ActionModel;

    class TransformationHandler implements TransformationHandlerInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        public function execute(AbstractModel $model): string
        {
            /** @var ActionModel $model */

            $data = $model->getData();

            if (isset($data['error'])) {
                $data['error'] = $this->getTranslator()->translate($data['error']);
            }

            return json_encode($data, JSON_PRETTY_PRINT);
        }
    }
}
