<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementInputProcessor;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Model\Document\Editable\Loader\EditableLoaderInterface;
use OpenDxp\Model\Document\PageSnippet;

abstract class Base
{
    use ServiceTrait;

    /**
     * @var EditableLoaderInterface
     */
    protected $editableLoader;

    public function __construct(EditableLoaderInterface $editableLoader, Service $graphQlService)
    {
        $this->editableLoader = $editableLoader;
        $this->graphQlService = $graphQlService;
    }

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

        $text = $newValue['text'];

        $editable = $this->editableLoader->build($editableType);
        $editable->setName($editableName);
        $editable->setDataFromResource($text);                   // this should be at least valid for input, wysiwyg

        if (method_exists($document, 'setElement')) {
            $document->setElement($editableName, $editable);
        } else {
            $document->setEditable($editable);
        }
    }
}
