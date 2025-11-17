<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use OpenDxp\Model\Document\Editable\Block;

class BlockType extends ObjectType
{
    protected static $instance;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            $config =
                [
                    'name' => 'document_editableBlock',
                    'fields' => [
                        '_editableName' => [
                            'type' => Type::string(),
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value instanceof Block) {
                                    return $value->getName();
                                }
                            },
                        ],
                        '_editableType' => [
                            'type' => Type::string(),
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value instanceof Block) {
                                    return $value->getType();
                                }
                            },
                        ],
                        'indices' => [
                            'type' => Type::listOf(Type::int()),
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value instanceof Block) {
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
