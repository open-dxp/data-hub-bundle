<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class MultiselectType extends ObjectType
{
    protected static $instance;

    /**
     * @return MultiselectType
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            $config =
                [
                    'name' => 'document_editableMultiselect',
                    'fields' => [
                        '_editableName' => [
                            'type' => Type::string(),
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value) {
                                    return $value->getName();
                                }
                            },
                        ],
                        '_editableType' => [
                            'type' => Type::string(),
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value instanceof \OpenDxp\Model\Document\Editable\Numeric) {
                                    return $value->getType();
                                }
                            },
                        ],
                        'selections' => [
                            'type' => Type::listOf(Type::string()),
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value instanceof \OpenDxp\Model\Document\Editable\Multiselect) {
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
