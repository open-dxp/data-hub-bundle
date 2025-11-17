<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class LinkType extends ObjectType
{
    protected static $instance;

    /**
     *
     * @return static
     */
    public static function getInstance(LinkDataType $linkDataType)
    {
        if (!self::$instance) {
            $config =
                [
                    'name' => 'document_editableLink',
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
                            'type' => $linkDataType,
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                return $value;
                            },
                        ],
                    ],
                ];
            self::$instance = new static($config);
        }

        return self::$instance;
    }
}
