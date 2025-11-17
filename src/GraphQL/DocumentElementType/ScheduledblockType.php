<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use OpenDxp\Model\Document\Editable\Scheduledblock;

class ScheduledblockType extends ObjectType
{
    protected static $instance;

    /**
     *
     * @return static
     */
    public static function getInstance(ScheduledblockDataType $scheduledblockDataType)
    {
        if (!self::$instance) {
            $config =
                [
                    'name' => 'document_editableScheduledblock',
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
                            'type' => Type::listOf($scheduledblockDataType),
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value instanceof Scheduledblock) {
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
