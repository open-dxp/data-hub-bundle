<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

class AreablockDataType extends ObjectType
{
    use ServiceTrait;

    public function __construct(Service $graphQlService)
    {
        $this->graphQlService = $graphQlService;

        $config =
            [
                'name' => 'document_editableAreablock_data',
                'fields' => [
                    '_editableType' => [
                        'type' => Type::string(),
                        'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                            if ($value) {
                                return $value->getType();
                            }
                        },
                    ],
                    '_editableName' => [
                        'type' => Type::string(),
                        'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                            if ($value) {
                                return $value->getName();
                            }
                        },
                    ],
                    'key' => [
                        'type' => Type::string(),
                        'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                            if (is_array($value)) {
                                return $value['key'];
                            }

                            return null;
                        },
                    ],
                    'type' => [
                        'type' => Type::string(),
                        'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                            if (is_array($value)) {
                                return $value['type'];
                            }

                            return null;
                        },
                    ],
                    'hidden' => [
                        'type' => Type::boolean(),
                        'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                            if (is_array($value)) {
                                return $value['hidden'];
                            }
                        },
                    ],
                ],
            ];
        parent::__construct($config);
    }
}
