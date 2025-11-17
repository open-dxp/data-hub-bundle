<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementInputProcessor;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\WorkspaceHelper;
use OpenDxp\Model\Asset;
use OpenDxp\Model\Document\PageSnippet;

class Image extends Base
{
    /**
     * @param PageSnippet $document
     * @param mixed $newValue
     * @param array $args
     * @param mixed $context
     */
    public function process($document, $newValue, $args, $context, ResolveInfo $info)
    {
        $dataFromEditMode = [];

        $assetId = $newValue['id'];
        $asset = Asset::getById($assetId);
        if (WorkspaceHelper::checkPermission($asset, 'read')) {
            $dataFromEditMode['id'] = $assetId;
        }

        if (isset($newValue['alt'])) {
            $dataFromEditMode['alt'] = $newValue['alt'];
        }

        $editableType = $newValue['_editableType'];

        $editable = $this->editableLoader->build($editableType);

        $editableName = $newValue['_editableName'];
        $editable->setName($editableName);

        $editable->setDataFromEditmode($dataFromEditMode);

        if (method_exists($document, 'setElement')) {
            $document->setElement($editableName, $editable);
        } else {
            $document->setEditable($editable);
        }
    }
}
