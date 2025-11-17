<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementInputProcessor;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Model\Document\PageSnippet;

class Embed extends Base
{
    /**
     * @param PageSnippet $document
     * @param mixed $newValue
     * @param array $args
     * @param mixed $context
     */
    public function process($document, $newValue, $args, $context, ResolveInfo $info)
    {
        $editableName = $newValue['_editableName'];
        $editableType = $newValue['_editableType'];

        $url = $newValue['url'];

        /** @var \OpenDxp\Model\Document\Editable\Embed $editable */
        $editable = $this->editableLoader->build($editableType);
        $editable->setName($editableName);
        $editable->setDataFromResource(serialize(['url' => $url]));                   // this should be at least valid for input, wysiwyg

        if (method_exists($document, 'setElement')) {
            $document->setElement($editableName, $editable);
        } else {
            $document->setEditable($editable);
        }
    }
}
