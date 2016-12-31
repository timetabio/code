<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Renderers\Page\Account
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Frontend\Models\Page\ResetPasswordPageModel;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Renderers\Page\PageRendererInterface;

    class ResetPasswordPageRenderer implements PageRendererInterface
    {
        public function render(PageModel $model, Document $template)
        {
            /** @var ResetPasswordPageModel $model */

            $main = $template->getMainElement();

            $header = $template->queryOne('//header[@class="page-header"]');
            $header->parentNode->removeChild($header);

            $wrapper = $template->createElement('div');
            $wrapper->setClassName('page-wrapper -padding');
            $main->appendChild($wrapper);

            $container = $template->createElement('div');
            $container->setClassName('flex-container -column -center-items');
            $wrapper->appendChild($container);

            $logoLink = $template->createElement('a');
            $logoLink->setClassName('_margin-before _margin-after');
            $logoLink->setAttribute('href', '/');
            $container->appendChild($logoLink);

            $logo = $template->createElement('img');
            $logo->setAttribute('src', '/images/logo.svg');
            $logo->setAttribute('width', '60px');
            $logo->setAttribute('height', '60px');
            $logoLink->appendChild($logo);

            $title = $template->createElement('h1');
            $title->setClassName('basic-heading-a _margin-after');
            $title->appendText('Password Reset');
            $container->appendChild($title);

            $form = $template->createElement('form');
            $form->setAttribute('action', '/action/reset');
            $form->setAttribute('method', 'post');
            $form->setAttribute('is', 'ajax-form');
            $form->setAttribute('class', 'form-box _margin-after');
            $container->appendChild($form);

            $formField = $template->createElement('label');
            $formField->setClassName('form-field -margin-after');
            $form->appendChild($formField);

            $label = $template->createElement('span');
            $label->setClassName('label');
            $label->appendText('New Password');
            $formField->appendChild($label);

            $input = $template->createElement('input');
            $input->setClassName('input basic-input');
            $input->setAttribute('type', 'password');
            $input->setAttribute('name', 'password');
            $input->setAttribute('placeholder', '•••••••••');
            $input->setAttribute('autocomplete', 'new-password');
            $formField->appendChild($input);

            $tokenInput = $template->createElement('input');
            $tokenInput->setAttribute('type', 'hidden');
            $tokenInput->setAttribute('name', 'reset-token');
            $tokenInput->setAttribute('value', $model->getResetToken());
            $form->appendChild($tokenInput);

            $error = $template->createElement('form-error');
            $error->setClassName('form-error');
            $form->appendChild($error);

            $submitButton = $template->createElement('button');
            $submitButton->setClassName('basic-button -full-width');
            $submitButton->setAttribute('type', 'submit');
            $submitButton->appendText('Reset Password');
            $form->appendChild($submitButton);
        }
    }
}
