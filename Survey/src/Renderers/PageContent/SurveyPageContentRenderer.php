<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Survey\Renderers\PageContent
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Renderers\Page\PageRendererInterface;
    use Timetabio\Survey\Models\Page\SurveyPageModel;

    class SurveyPageContentRenderer implements PageRendererInterface
    {
        /**
         * @var array
         */
        private $choices = [
            2 => 'Strongly Agree',
            1 => 'Agree',
            0 => 'Neither agree or disagree',
            -1 => 'Disagree',
            -2 => 'Strongly disagree',
        ];

        public function render(PageModel $model, Document $template)
        {
            /** @var SurveyPageModel $model */

            $questions = $model->getQuestions();
            $main = $template->getMainElement();

            $wrapper = $template->createElement('div');
            $wrapper->setClassName('page-wrapper -padding');
            $main->appendChild($wrapper);

            $logoContainer = $template->createElement('div');
            $logoContainer->setClassName('flex-container -column -center-items');
            $wrapper->appendChild($logoContainer);

            $logoLink = $template->createElement('a');
            $logoLink->setClassName('_margin-after-l');
            $logoLink->setAttribute('href', '/');
            $logoContainer->appendChild($logoLink);

            $logoImage = $template->createElement('img');
            $logoImage->setAttribute('src', '/images/logo.svg');
            $logoImage->setAttribute('width', '60px');
            $logoImage->setAttribute('height', '60px');
            $logoLink->appendChild($logoImage);

            $form = $template->createElement('form');
            $form->setAttribute('is', 'ajax-form');
            $form->setAttribute('action', '/action/survey');
            $form->setAttribute('method', 'post');
            $wrapper->appendChild($form);

            foreach ($questions as $question) {
                $questionCard = $template->createElement('div');
                $questionCard->setClassName('survey-question-card');
                $form->appendChild($questionCard);

                $questionTitle = $template->createElement('h2');
                $questionTitle->setClassName('title');
                $questionTitle->appendText($question['title']);
                $questionCard->appendChild($questionTitle);

                $inputName = 'answers[' . $question['id'] . ']';

                foreach ($this->choices as $choice => $label) {
                    $choiceElement = $template->createElement('label');
                    $choiceElement->setClassName('choice');
                    $questionCard->appendChild($choiceElement);

                    $choiceInput = $template->createElement('input');
                    $choiceInput->setClassName('input');
                    $choiceInput->setAttribute('type', 'radio');
                    $choiceInput->setAttribute('required', '');
                    $choiceInput->setAttribute('value', $choice);
                    $choiceInput->setAttribute('name', $inputName);
                    $choiceElement->appendChild($choiceInput);

                    $choiceLabel = $template->createElement('span');
                    $choiceLabel->setClassName('label');
                    $choiceLabel->appendText($label);
                    $choiceElement->appendChild($choiceLabel);
                }
            }

            if ($model->getVersion() === 'post') {
                $commentBox = $template->createElement('textarea');
                $commentBox->setClassName('basic-input -textarea _margin-after-l');
                $commentBox->setAttribute('is', 'auto-textarea');
                $commentBox->setAttribute('name', 'comment');
                $commentBox->setAttribute('placeholder', '(Optional) Write a comment ...');
                $form->appendChild($commentBox);
            }

            $betaRequest = $template->createElement('input');
            $betaRequest->setAttribute('type', 'hidden');
            $betaRequest->setAttribute('name', 'beta_request');
            $betaRequest->setAttribute('value', $model->getBetaRequest()['id']);
            $form->appendChild($betaRequest);

            $version = $template->createElement('input');
            $version->setAttribute('type', 'hidden');
            $version->setAttribute('name', 'version');
            $version->setAttribute('value', $model->getVersion());
            $form->appendChild($version);

            $submitButton = $template->createElement('button');
            $submitButton->setClassName('basic-button -full-width');
            $submitButton->setAttribute('type', 'submit');
            $submitButton->setAttribute('disabled', '');
            $submitButton->appendText('Submit');

            $form->appendChild($submitButton);
        }
    }
}
