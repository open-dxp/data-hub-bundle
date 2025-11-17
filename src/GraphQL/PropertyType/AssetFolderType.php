<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\PropertyType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\ElementDescriptor;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Bundle\DataHubBundle\WorkspaceHelper;
use OpenDxp\Model\Element\Data\MarkerHotspotItem;
use OpenDxp\Model\Property;

class AssetFolderType extends ObjectType
{
    use ServiceTrait;

    /**
     *
     * @throws \Exception
     */
    public function __construct(Service $graphQlService)
    {
        $this->graphQlService = $graphQlService;
        $assetFolderType = $this->getGraphQlService()->getAssetTypeDefinition('_asset_folder');

        $config = [
            'name' => 'property_assetfolder',
            'fields' => [
                'name' => [
                    'type' => Type::string(),
                    'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                        if ($value instanceof MarkerHotspotItem || $value instanceof Property) {
                            return $value->getName();
                        }
                    },
                ],
                'type' => [
                    'type' => Type::string(),
                    'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                        if ($value instanceof MarkerHotspotItem || $value instanceof Property) {
                            return $value->getType();
                        }
                    },
                ],
                'asset' => [
                    'type' => $assetFolderType,
                    'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) use ($graphQlService) {
                        $element = null;
                        if ($value instanceof MarkerHotspotItem) {
                            $element = \OpenDxp\Model\Element\Service::getElementById($value->getType(), $value->getValue());
                        } elseif ($value instanceof Property) {
                            $element = $value->getData();
                        }
                        if ($element) {
                            if (!WorkspaceHelper::checkPermission($element, 'read')) {
                                return null;
                            }
                            $data = new ElementDescriptor($element);
                            $graphQlService->extractData($data, $element, $args, $context, $resolveInfo);

                            return $data;
                        }

                        return null;
                    },

                ]]];

        parent::__construct($config);
    }
}
