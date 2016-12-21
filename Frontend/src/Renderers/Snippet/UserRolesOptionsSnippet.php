<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
