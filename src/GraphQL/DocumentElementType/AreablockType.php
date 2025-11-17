<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use OpenDxp\Model\Document\Editable\Areablock;

class AreablockType extends ObjectType
{
    protected static $instance;

    /**
     *
     * @return static
     */
    public static function getInstance(AreablockDataType $areablockDataType)
    {
        if (!self::$instance) {
            $config =
                [
                    'name' => 'document_editableAreablock',
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
                        'data' => [
                            'type' => Type::listOf($areablockDataType),
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value instanceof Areablock) {
                                    return $value->getData();
                                }
                            },
                        ],

                    ],
                ];
            self::$instance = new static($config);
        }

        return self::$instance;
    }
}
