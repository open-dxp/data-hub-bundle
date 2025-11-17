<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementInputProcessor;

use OpenDxp\Model\Document\PageSnippet;

trait EditablesTrait
{
    /**
     * @param string $editableName
     *
     * @return void
     */
    public function cleanEditables(PageSnippet $document, $editableName)
    {
        $editables = $document->getEditables();

        foreach ($editables as $editable) {
            $name = $editable->getName();
            if ($name === $editableName || strpos($name, $editableName . '.') === 0) {
                $document->removeEditable($name);
            }
        }
    }
}
