<?php
/**
 * (c) 2016 Ruben Schmidmeister
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

            $betaRequest = $template->createElement('input');
            $betaRequest->setAttribute('type', 'hidden');
            $betaRequest->setAttribute('name', 'beta_request');
            $betaRequest->setAttribute('value', $model->getBetaRequest()['id']);
            $form->appendChild($betaRequest);

            $submitButton = $template->createElement('button');
            $submitButton->setClassName('basic-button');
            $submitButton->setAttribute('type', 'submit');
            $submitButton->setAttribute('disabled', '');
            $submitButton->appendText('Submit');

            $form->appendChild($submitButton);
        }
    }
}
