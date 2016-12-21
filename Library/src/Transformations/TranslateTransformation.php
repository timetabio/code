<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Transformations
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Framework\Dom\Element;
    use Timetabio\Framework\Translation\TranslatorInterface;
    use Timetabio\Frontend\Models\PageModel;

    class TranslateTransformation implements TransformationInterface
    {
        /**
         * @var TranslatorInterface
         */
        private $translator;

        public function __construct(TranslatorInterface $translator)
        {
            $this->translator = $translator;
        }

        public function apply(PageModel $model, Document $template)
        {
            $translateElements = $template->query('//translate');

            /** @var Element $element */
            foreach ($translateElements as $element) {
                $key = $element->nodeValue;
                $context = $element->getAttribute('context');

                $message = $this->translator->translate($key, $context);

                $element->parentNode->replaceChild(
                    $template->createTextNode($message),
                    $element
                );
            }
        }
    }
}
