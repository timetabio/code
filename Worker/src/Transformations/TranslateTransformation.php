<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Worker\Transformations
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Framework\Dom\Element;
    use Timetabio\Framework\Translation\TranslatorInterface;

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

        public function apply(Document $template)
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
