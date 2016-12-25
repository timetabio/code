<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Renderers\Snippet
{
    use Timetabio\Framework\Dom\{
        Document, Element, Fragment
    };
    use Timetabio\Library\UserRoles\{
        DefaultUserRole, Moderator, Owner
    };
    use Timetabio\Library\UserRoles\UserRole;

    class UserRolesOptionsSnippet
    {
        public function render(Document $document, string $selected = null): Fragment
        {
            $fragment = $document->createDocumentFragment();

            $fragment->appendChild($this->renderOption($document, new DefaultUserRole, $selected));
            $fragment->appendChild($this->renderOption($document, new Moderator, $selected));
            $fragment->appendChild($this->renderOption($document, new Owner, $selected));

            return $fragment;
        }

        private function renderOption(Document $document, UserRole $role, string $selected = null): Element
        {
            $value = (string) $role;
            $option = $document->createElement('option', $role->getLabel());

            $option->setAttribute('value', $value);

            if ($value === $selected) {
                $option->setAttribute('selected', '');
            }

            return $option;
        }
    }
}
