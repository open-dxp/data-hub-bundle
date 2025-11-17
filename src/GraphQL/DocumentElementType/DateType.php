<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType;

use Carbon\Carbon;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use OpenDxp\Model\Document\Editable\Date;

class DateType extends ObjectType
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
                    'name' => 'document_editableDate',
                    'fields' => [
                        '_editableName' => [
                            'type' => Type::string(),
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value instanceof Date) {
                                    return $value->getName();
                                }
                            },
                        ],
                        '_editableType' => [
                            'type' => Type::string(),
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value instanceof Date) {
                                    return $value->getType();
                                }
                            },
                        ],
                        'timestamp' => [
                            'type' => Type::int(),
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value instanceof Date) {
                                    $data = $value->getData();
                                    if ($data instanceof Carbon) {
                                        return $data->getTimestamp();
                                    }
                                }
                            },
                        ],
                        'formatted' => [
                            'type' => Type::string(),
                            'args' => ['format' => ['type' => Type::nonNull(Type::string()), 'description' => 'see Carbon::format']],
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value instanceof Date) {
                                    $data = $value->getData();
                                    if ($data instanceof Carbon) {
                                        $format = $args['format'];
                                        $formattedValue = $data->format($format);

                                        return $formattedValue;
                                    }
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
